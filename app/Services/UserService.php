<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository;

final class UserService
{
    /**
     * @throws UserNotFoundException
     */
    public static function getByEmail(string $email): User
    {
        $user = UserRepository::getByEmail(email: $email);

        if ($user === null) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
