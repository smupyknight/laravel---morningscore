<?php

namespace App\Console\Commands\Generate;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use App\Models\Company;
use App\Models\User as UserModel;

use App\Mail\BetaWelcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App;

class User extends Command
{
    protected $signature = 'generate:users {email}';
    protected $description = 'Generate a single user from email address';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
		if ($this->argument('email') === null) {
			$this->error('Email not provided');
			return;
		}

		$email = $this->argument('email');

		$this->info("Attempting user creation with email $email");

		if (UserModel::where('email', $email)->exists()) {
			$this->error('Email taken: ' . $email);
			return;
		}

		$password = $this::generatePass();
		$lang = 'da';

		try {
			$user = UserModel::create([
				'email' => $email,
				'password' => bcrypt($password),
				'lang' => $lang,
			]);
			$user->assign(['customer']);
			$this->info('User created');

		} catch (\Exception $e) {
			$this->error('Something went wrong while creating the user.');
			\Log::error($e);
			return;
		}
		
		try {
			$this->info('Sending email');
			App::setLocale($user->lang);
			Mail::to($user)->send(new BetaWelcome($user, $password));
			$this->info('Email sent');

		} catch (\Exception $e) {
			$this->error('Something went wrong while sending the email.');
			\Log::error($e);
			return;
		}

		$this->info('User creation complete.');
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

