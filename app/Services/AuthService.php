<?php

declare(strict_types=1);

namespace App\Services;

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
        return Auth::guard("sanctum")->user();
    }
}
