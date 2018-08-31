<?php

namespace App\Console\Commands\ViralLoops;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\ViralLoopsUser;
use App\Integrations\ViralLoops\ViralLoops;


class FetchUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'viral-loops:fetch-users {email?} {--campaign=current}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    protected $campaign;
    protected $client;

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
            $this->info('Fetching single user with the email ' . $this->argument('email'));
            $this->single();

        } else {
            // all
            $this->info('Fetching data for all users');
            $this->all();
        }
    }
    
    public function single()
    {
        $email  = $this->argument('email');
        $user   = User::where('email', $email)
                    ->whereDoesntHave('viralLoops', function($q) {
                        $q->where('campaign', $this->campaign);
                    })
                    ->first();
        
        if ($user === null) {
            $this->error('User doesn\'t exist, or already has campaign refference');
            return null;
        }
        
        $this->fetchData($user);
        $this->info('Done');
    }
    
    public function all()
    {
        $users = User::whereDoesntHave('viralLoops', function($q) {
                        $q->where('campaign', $this->campaign);
                    })
                    ->get();
        
        $count = count($users);
        $this->info('Found ' . $count . ' users.');
        $bar = $this->output->createProgressBar($count);

        foreach ($users as $user) {
            $this->fetchData($user);
            $bar->advance();
        }
        
        $bar->finish();
        $this->info('Done');
    }
    
    public function fetchData(User $user)
    {
        $res = json_decode($this->client->userData($user->email, ['referrerInfo']));
        sleep(1);
        
        if ( !isset($res->referralCode)) {
            return null;
        }

        $ref_code = $res->referralCode;
        
        if ( ! empty($res->referrerInfo) && isset($res->referrerInfo->referralCode)) {
            $referrer = $res->referrerInfo->referralCode;
        } else {
            $referrer = null;
        }
        
        ViralLoopsUser::create([
            'user_id'       => $user->id,
            'campaign'      => $this->campaign,
            'referral_code' => $ref_code,
            'referrer'      => $referrer,
        ]);
        
        return true;
    }
}
