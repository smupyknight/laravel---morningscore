<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

	public $user;
	public $locale;

    public function __construct(User $user)
    {
		$this->user = $user;
		$this->lang = $user->lang ?? 'en';
    }

    public function build()
    {
		\App::setLocale($this->lang);
		return $this
            ->subject(trans('mail.welcome.subject'))
			->view('mails.portal.welcome-mail');
    }
}
