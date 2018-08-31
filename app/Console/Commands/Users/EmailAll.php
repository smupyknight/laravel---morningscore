<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\EmailAttempt;
use Illuminate\Support\Facades\App;

class EmailAll extends Command
{
    protected $signature = 'users:email-all {mailable_class}';
    protected $description = 'Send an Mailable to all users, which haven\'t recieved it yet';
	public $base_mailables = "App\\Mail\\";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		$mail_class = $this->base_mailables . $this->argument('mailable_class');

		if ( ! class_exists($mail_class) ) {
			$this->error('Please provide a valid mailable class.');
			return;
		}
		resolve($mail_class); // Additional validation: this will throw error if class dosen't exist

		$users = User::whereDoesntHave('emailAttempts', function ($q) use ($mail_class) {
			$q->where('mailable_class', $mail_class);
		})->get();

		if ($users->isEmpty()) {
			$this->error('Could not find any users which haven\'t recieved this email already.');
			return;
		}

		if ( ! $this->confirm("Are you sure you want to send the " . class_basename($mail_class) . " mailable to " . count($users) . " users?")) {
			$this->info('Aborting.');
			return;
		}
		$this->info('Sending email to ' . count($users) . ' users.');

		$bar = $this->output->createProgressBar(count($users));
		$headers = ['User id', 'User Email'];
		$failed = [];

		foreach ($users as $user) {
			try {
				$lang = isset($user->lang) ? $user->lang : 'en';
				App::setLocale($lang);
				Mail::to($user)->send(new $mail_class());
				$bar->advance();

			} catch (\Exception $e) {
				\Log::error('Couln\'t send email to user', [
					'id' 				=> $user->id,
					'email'				=> $user->email,
					'mailable_class'	=> $mail_class,
				]);
				$failed[] = [
					$user->id,
					$user->email,
				];
				$bar->advance();
				continue;
			}

			EmailAttempt::create([
				'user_id' 			=> $user->id,
				'mailable_class'	=> $mail_class,
			]);
		}
		$bar->finish();

		$this->info(PHP_EOL);
		$this->error('Failed users');
		$this->table($headers, $failed);

		$this->info('Done.');
    }
}
