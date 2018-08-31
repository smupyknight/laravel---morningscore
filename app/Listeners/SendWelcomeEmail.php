<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    public function handle(UserCreated $event)
    {
		Mail::to($event->user)->send(new WelcomeEmail($event->user));
    }
}
