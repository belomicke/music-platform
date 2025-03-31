<?php

declare(strict_types=1);

namespace App\Queries\EmailVerificationCode;

use App\Models\EmailVerificationCode;

final class DeleteEmailVerificationCodeQuery
{
    public function execute(string $email): void
    {
        EmailVerificationCode::query()
            ->where("email", $email)
            ->delete();
    }
}
