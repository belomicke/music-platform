<?php

declare(strict_types=1);

namespace App\Queries\PasswordResetToken;

use Illuminate\Support\Facades\DB;

final class GetPasswordResetTokenByEmailExistsQuery
{
    public function execute(string $email): bool
    {
        return DB::table("password_reset_tokens")
            ->where("email", $email)
            ->exists();
    }
}
