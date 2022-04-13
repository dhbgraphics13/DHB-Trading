<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class UserWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;


    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {

        return $this->from('info@domain.com')
            ->subject('Congratulations')
            ->view('emails.welcome')
            ->with('data', $this->user);
    }



}

