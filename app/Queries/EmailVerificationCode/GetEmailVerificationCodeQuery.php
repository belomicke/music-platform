<?php

declare(strict_types=1);

namespace App\Queries\EmailVerificationCode;

use App\Models\EmailVerificationCode;

final class GetEmailVerificationCodeQuery
{
    public function execute(string $email): EmailVerificationCode|null
    {
        return EmailVerificationCode::query()
            ->where("email", $email)
            ->first();
    }
}
