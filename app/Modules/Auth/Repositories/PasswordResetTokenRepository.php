<?php

declare(strict_types=1);

namespace App\Modules\Auth\Repositories;

use Illuminate\Support\Facades\DB;

final class PasswordResetTokenRepository
{
    public function getByEmail(string $email): bool
    {
        return DB::table("password_reset_tokens")
            ->where("email", $email)
            ->exists();
    }
}
