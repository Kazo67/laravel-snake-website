<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
        $this->subject = 'Dziękujemy za założenie konta!';
    }

    public function build()
    {
        return $this->markdown('emails.welcome', [
            'user' => $this->user
        ]);
    }
}
