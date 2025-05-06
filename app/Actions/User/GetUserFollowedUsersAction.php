<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTOs\User\UserMediaListDTO;
use App\Models\User;

final class GetUserFollowedUsersAction
{
    public function execute(User $user): UserMediaListDTO
    {
        $users = $user->followed_users()->get();
        $count = $user->followed_users_count;

        return new UserMediaListDTO(
            users: $users,
            count: $count
        );
    }
}
