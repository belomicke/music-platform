<?php

declare(strict_types=1);

namespace App\Modules\Auth\Actions;

use App\Models\EmailVerificationCode;
use App\Modules\Auth\Mail\SendEmailVerificationCode;
use App\Modules\Auth\Repositories\EmailVerificationCodeRepository;
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
