<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BetaWelcome extends Mailable
{
    use Queueable, SerializesModels;

	public $user;
	public $link = 'hi';
	public $email;
	public $pass;

    public function __construct(User $user, string $pass)
    {
        $this->user		= $user;
		$this->email	= $user->email;
		$this->pass		= $pass;
    }

    public function build()
    {
        $this
            ->subject(trans('mail.beta_welcome.subject'))
            ->view('mails.portal.beta-welcome');
    }
}
