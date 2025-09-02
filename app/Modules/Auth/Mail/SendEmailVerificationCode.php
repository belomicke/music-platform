<?php

declare(strict_types=1);

namespace App\Modules\Auth\Mail;

use App\Models\EmailVerificationCode;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

final class SendEmailVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public EmailVerificationCode $emailVerificationCode
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Email Verification Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.auth.email-verification-code',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
