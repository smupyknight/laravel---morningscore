<?php

namespace App\Console\Commands\ViralLoops;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ViralLoopsUser;
use App\Models\ViralLoopsReward;
use App\Integrations\ViralLoops\ViralLoops;


class FetchRewards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viral-loops:fetch-rewards {email?} {--campaign=current} {--redeemed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    protected $campaign;
    protected $client;
    protected $rewards  = null;
    protected $count    = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->campaign = $this->option('campaign');
        $this->client = new ViralLoops($this->campaign);
        
        if ($this->argument('email') !== null) {
            $this->info('Fetching rewards for user with the email ' . $this->argument('email'));
            $this->single();

        } else {
            // all
            $this->info('Fetching all rewards');
            $this->fetchData();
        }
        
        $this->info('Fetched ' . $this->count . ' rewards');
        
        if ($this->count > 0 && !empty($this->rewards)) {
            $created = $this->createRewards();
            $this->info('Created ' . $created . ' rewards');
        }
        
        $this->info('Done');
    }
    
    public function single()
    {
        $email  = $this->argument('email');
        $user   = User::where('email', $email)
                    ->whereHas('viralLoops', function($q) {
                        $q->where('campaign', $this->campaign);
                    })
                    ->first();
        
        if ($user === null) {
            $this->error('User doesn\'t exist, or doesnt have campaign refference');
            return null;
        }
        
        $this->fetchData($user->email);
    }
    
    public function fetchData(string $email = '')
    {
        $processed = 0;
        $total = 25;
        
        while ($processed < $total) {
            // make call
            if ($this->option('redeemed')) {
                $res = json_decode($this->client->redeemedRewards($email, 25, $processed));
                $total = $res->totalGiven;
                $content = $res->given;

            } else {
                $res = json_decode($this->client->pendingRewards($email, 25, $processed));
                $total = $res->totalPending;
                $content = $res->pending;
            }
            sleep(1);
            
            // assess number of items
            if ($total <= 0 || empty($content)) {
                return null;
            }

            $this->processResponse($content);

            $processed  += $this->count;
        }
    }
    
    public function processResponse(array $data)
    {
        if ($this->rewards === null) {
            $this->rewards = [];
        }

        // iterate users
        foreach ($data as $user) {
            $key = $user->user->referralCode;
            $value = [];
            
            // iterate user rewards
            foreach ($user->rewards as $reward) {
                $value[$reward->id] = $reward->metadata->milestoneReward->details->itemName;
                $this->count += 1;
            }
            
            $this->rewards[$key] = $value;
        }
    }
    
    public function createRewards()
    {
        $users = ViralLoopsUser::where('campaign', $this->campaign)
                                ->whereHas('user')
                                ->whereIn('referral_code', array_keys($this->rewards))
                                ->get()
                                ->keyBy('referral_code');
        
        $created = 0;
        
        foreach ($this->rewards as $code => $rewards) {
            
            $user = $users->get($code);
            
            if ($user === null) {
                continue;
            }
            
            foreach ($rewards as $id => $name) {
                $args = [
                    'viral_loops_user_id'   => $user->id,
                    'viral_loops_id'        => $id,
                    'reward_name'           => $name,
                ];
                
                if ($this->option('redeemed')) {
                    $args['is_redeemed'] = true;
                }
                
                $reward = ViralLoopsReward::firstOrCreate($args);
                
                if ($reward->wasRecentlyCreated) {
                    $created += 1;
                }
            }
        }
        
        return $created;
    }
}
