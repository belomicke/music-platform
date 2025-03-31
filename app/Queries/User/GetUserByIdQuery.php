<?php

declare(strict_types=1);

namespace App\Queries\User;

use App\Models\User;

final class GetUserByIdQuery
{
    public function execute(string $id): User|null
    {
        return User::query()->where("uuid", $id)->first();
    }
}
