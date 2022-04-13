<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoFactorOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {

        return $this->from('donotreply@domain.com')
            ->subject('Two Factor OTPn from laravel app')
            ->view('emails.twoFactorOtp')
            ->with('data', $this->data);

    }
}
