<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;

final class GetUserByEmailQuery
{
    public function execute(string $email): User|null
    {
        return User::query()
            ->where("email", $email)
            ->first();
    }
}
