<?php

namespace App\Mail\Roadmap;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class V1_2NewUsers extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
		\App::setLocale('en');
        $this
            ->subject(trans('mail.v1_2.subject'))
            ->view('mails.portal.v1_2_new_users');
    }
}
