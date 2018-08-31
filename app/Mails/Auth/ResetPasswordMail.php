<?php

namespace App\Mails\Auth;

use App\Models\User;
use Illuminate\Mail\Mailable;

class ResetPasswordMail extends Mailable
{
    public $user;
    public $link;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->link = route('auth.reset-password', [$token]);
    }

    public function build()
    {
        $this
            ->subject(transOr('mails.auth.reset-password', 'Password reset request'))
            ->view('mails.auth.reset-password');
    }

}
