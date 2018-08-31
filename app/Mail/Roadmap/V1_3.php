<?php

namespace App\Mail\Roadmap;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class V1_3 extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
        $this
            ->subject(trans('mail.v1_3.subject'))
            ->view('mails.portal.v1_3');
    }
}
