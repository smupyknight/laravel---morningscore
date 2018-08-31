<?php

namespace App\Console\Commands\System;

use Illuminate\Console\Command;

class Build extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'system:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reloads config and runs migrations';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        // Config
        //

        $this->call('config:cache');

        //
        // Migrations
        //

        $this->call('db:drop');
        //$this->call('migrate:reset');
        $this->call('migrate');

        //
        // ACL
        //

        $this->call('acl:build');
        $this->call('acl:seed');

        //
        // Seed
        //

        $this->call('db:seed');

        //
        // Passport
        //

        $this->call('passport:install');

        $this->info('The system was successfully rebuilt.');
    }
}
