<?php

namespace App\Console;

use App\Console\Commands\FetchSignupEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        FetchSignupEmails::class,
        Commands\System\Build::class,
        Commands\Test\Email::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
		$schedule->command('sync:track-keywords')->everyTenMinutes();
		$schedule->command('admin:new-domains-report')->timezone('Europe/Copenhagen')->twiceDaily(7, 19);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
    }
}
