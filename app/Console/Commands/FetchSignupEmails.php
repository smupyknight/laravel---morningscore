<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchSignupEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
    protected $client;
    protected $exclude = [
        'gmail.com',
        'gmai.com',
        'hotmail.com',
        'hotmail.dk',
        'icloud.com',
        'me.com',
        'mac.com',
        'outlook.com',
        'yahoo.com',
        'yahoo.dk',
        'live.dk',
        'live.com',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'base_uri' => 'https://us3.api.mailchimp.com/3.0/',
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $emails = json_decode($this->fetch())->members;

        $file = fopen("emails.txt", "w"); 
        $dupes = fopen("duplicates.txt", "w"); 
        
        $emails = $this->filter($emails);
        
        foreach ($emails['emails'] as $email) {
            $text = $email . PHP_EOL;
            fwrite($file, $text);
        }
        
        foreach ($emails['dupes'] as $dupe) {
            $text = $dupe . PHP_EOL;
            fwrite($dupes, $text);
        }

        fclose($file);
        fclose($dupes);
        
    }
    
    public function fetch()
    {
        $endpoint = 'lists/3885cdc005/members';
        $args = [
            'count' => 1000,
            'fields' => 'members.email_address',
        ];
        
        $members = $this->client->request('GET', $endpoint, [
            'auth' => ['user', 'b56c9c257e5e2e2d61f3c8124b877262-us3'],
            'query' => $args
        ]);
        
        return strtolower($members->getBody());
    }
    
    public function filter($input)
    {
        $emails = [];
        $dupes = [];
        
        foreach ($input as $email) {
            $address = explode('@', $email->email_address);
            $domain = array_pop($address);
            
            if ( !in_array($domain, $emails)) {
                $emails[] = $domain;
            } else {
                $dupes[] = $domain;
            }
        }
        
        $emails = array_diff($emails, $this->exclude);
        
        sort($emails);
        sort($dupes);
        
        $output = [
            'emails' => $emails,
            'dupes' => $dupes,
        ];
        
        return $output;
    }
}
