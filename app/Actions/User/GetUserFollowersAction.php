<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTOs\User\UserMediaListDTO;
use App\Models\User;
use App\Repositories\UserRepository;

final readonly class GetUserFollowersAction
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function execute(User $user, int $offset = 0): UserMediaListDTO
    {
        return $this->users->getFollowers(
            user: $user,
            offset: $offset
        );
    }
}
