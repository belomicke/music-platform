<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Mail\SendEmailVerificationCode;
use App\Models\EmailVerificationCode;
use App\Repositories\EmailVerificationCodeRepository;
use Illuminate\Support\Facades\Mail;

final readonly class SendEmailVerificationCodeAction
{
    public function __construct(
        private EmailVerificationCodeRepository $emailVerificationCodes,
    ) {}

    public function execute(string $email): void
    {
        $code = $this->emailVerificationCodes->getByEmail(email: $email);

        if ($code) {
            $this->sendMail(code: $code);
            return;
        }

        $code = $this->emailVerificationCodes->create(email: $email);

        $this->sendMail(code: $code);
    }

    private function sendMail(EmailVerificationCode $code): void
    {
        Mail::to($code->email)->send(new SendEmailVerificationCode($code));
    }
}
