<?php

declare(strict_types=1);

namespace App\Modules\User\Services;

use App\Models\User;
use App\Modules\User\Repositories\UserRepository;

final class UserService
{
    public static function getByEmail(string $email): User|null
    {
        return UserRepository::getByEmail(email: $email);
    }
}
