<?php

namespace App\Console\Commands\Generate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\User;
use App\Mail\BetaWelcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;

class BetaUsers extends Command
{
    protected $signature = 'generate:beta-users {file}';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		if ($this->argument('file') === null) {
			$this->error('File name not provided');
			return;
		}

		$file = $this->argument('file');
		$json = Storage::get($file);
		$data = json_decode($json);

		if ($data === null || ! is_array($data)) {
			$this->error('File couldn\'t be read');
			return;
		}

		$bar = $this->output->createProgressBar(count($data));
        
        foreach ($data as $beta_user) {
			\Log::info('Attempting user creation: ' . print_r($beta_user, true));

			if (User::where('email', $beta_user->email)->exists()) {
				$this->error('Email taken: ' . $beta_user->email);
				$bar->advance();
				continue; // skip user
			}

			$password = $this::generatePass();
			$lang = isset($beta_user->lang) ? $beta_user->lang : 'en';

            $user = User::create([
                'email' => $beta_user->email,
        		'password' => bcrypt($password),
        		'lang' => $lang,
            ]);
			$user->assign(['customer']);
			\Log::info('User created');
            
            if (isset($beta_user->domain) && is_string($beta_user->domain) && strlen($beta_user->domain) > 0) {
				\Log::info('Creating company');
            	$company = Company::setup($user, $beta_user->domain);

				if (!empty($beta_user->competitors) && is_array($beta_user->competitors)) {
					\Log::info('Creating competitors');
					$company->domains()->first()->addCompetitors($beta_user->competitors);
				}
			}

			\Log::info('Sending email');
			App::setLocale($user->lang);
			Mail::to($user)->send(new BetaWelcome($user, $password));
			\Log::info('User creation complete.');
			$bar->advance();
        }
		$bar->finish();
    }

    public static function generatePass(int $length = 10, array $exclude = ['/', '+', '=', 'l', 'I', '1', 'o', 'O', '0'])
    {
        $pass = '';

        while (($len = strlen($pass)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $pass .= substr(str_replace($exclude, '', base64_encode($bytes)), 0, $size);
        }

        return $pass;
    }
}

