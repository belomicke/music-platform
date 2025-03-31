<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Mail\SendEmailVerificationCode;
use App\Models\EmailVerificationCode;
use App\Queries\EmailVerificationCode\CreateEmailVerificationCodeQuery;
use App\Queries\EmailVerificationCode\GetEmailVerificationCodeQuery;
use Illuminate\Support\Facades\Mail;

final readonly class SendEmailVerificationCodeAction
{
    public function __construct(
        private GetEmailVerificationCodeQuery    $getEmailVerificationCodeQuery,
        private CreateEmailVerificationCodeQuery $createEmailVerificationCodeQuery,
    ) {}

    public function execute(string $email): void
    {
        $code = $this->getEmailVerificationCodeQuery->execute(email: $email);

        if ($code) {
            $this->sendMail(code: $code);
            return;
        }

        $code = $this->createEmailVerificationCodeQuery->execute(email: $email);

        $this->sendMail(code: $code);
    }

    private function sendMail(EmailVerificationCode $code): void
    {
        Mail::to($code->email)->send(new SendEmailVerificationCode($code));
    }
}
