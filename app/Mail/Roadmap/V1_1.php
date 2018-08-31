<?php

namespace App\Mail\Roadmap;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class V1_1 extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
        $this
            ->subject(trans('mail.v1_1.subject'))
            ->view('mails.portal.v1_1');
    }
}
