<?php

namespace App\Console\Commands\Users;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class EmailList extends Command
{
    protected $signature = 'users:email-list {mailable_class} {file}';
    protected $description = 'Send an Mailable to a list of users';
	public $base_mailables = "App\\Mail\\";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		// Find mailable class
		$mail_class = $this->base_mailables . $this->argument('mailable_class');

		if ( ! class_exists($mail_class) ) {
			$this->error('Please provide a valid mailable class.');
			return;
		}
		resolve($mail_class); // Additional validation: this will throw error if class dosen't exist

		// Find and decode file
		try {
			$file = Storage::get($this->argument('file'));
		} catch (\Exception $e) {
			$this->error('Could not read the provided file');
			return;
		}

		// Define list of user emails
		$emails = explode(PHP_EOL, $file);
		if (! is_array($emails)) {
			$this->error('Invalid file input provided');
			return;
		}
		$emails = array_unique(array_filter(array_map('trim', $emails)));


		if ( ! $this->confirm("Are you sure you want to send the " . class_basename($mail_class) . " mailable to " . count($emails) . " emails?")) {
			$this->info('Aborting.');
			return;
		}
		$this->info('Sending email to ' . count($emails) . ' users.');

		$bar = $this->output->createProgressBar(count($emails));
		$headers = ['Email'];
		$failed = [];

		foreach ($emails as $email) {
			try {
				App::setLocale('en');
				Mail::to($email)->send(new $mail_class());
				$bar->advance();

			} catch (\Exception $e) {
				\Log::error('Couln\'t send email to email', [
					'email'				=> $email,
					'mailable_class'	=> $mail_class,
				]);
				$failed[] = [
					$email,
				];
				$bar->advance();
				continue;
			}
		}
		$bar->finish();

		$this->info(PHP_EOL);
		$this->error('Failed users');
		$this->table($headers, $failed);

		$this->info('Done.');
    }
}
