<?php

declare(strict_types=1);

namespace App\Modules\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class AuthService
{
    public static function check(): bool
    {
        return Auth::guard("sanctum")->check();
    }

    public static function user(): User|null
    {
        if (AuthService::check() === false) {
            return null;
        }

        return Auth::guard("sanctum")->user();
    }
}
