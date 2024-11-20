<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $otp)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your OTP Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.send_otp',
            with: [
                'otp' => $this->otp,
            ],
        );
    }
}
