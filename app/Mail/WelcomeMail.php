<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->from(env('MAIL_USERNAME') , 'Muhammad Haris Munir')->subject('Email Verification')->markdown('emails.Welcome', ['email_data' => $this->email_data]);
        //return $this->from(env('MAIL_USERNAME'), 'coder aweso.me')->subject("Welcome to Coderaweso.me!")->view('mail.signup-email', ['email_data' => $this->email_data]);
        return $this->from(env('MAIL_USERNAME') , 'Muhammad Haris Munir')->subject('Email Verification')->view('emails.signup-email', ['email_data' => $this->email_data]);
    }

    /*public function __construct($data)
    {
        $this->mail_data = $data;
    }

    , ['$data'=>$this->mail_data]*/
}
