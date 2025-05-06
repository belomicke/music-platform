<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\DTOs\User\UserMediaListDTO;
use App\Models\User;
use App\Repositories\UserRepository;

final readonly class GetUserFollowingAction
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function execute(
        User   $user,
        string $type,
        int    $offset = 0
    ): ArtistMediaListDTO|UserMediaListDTO
    {
        return match ($type) {
            "artists" => $this->getArtists(user: $user, offset: $offset),
            "users" => $this->getUsers(user: $user, offset: $offset),
        };
    }

    private function getArtists(User $user, int $offset): ArtistMediaListDTO
    {
        return $this->users->getFollowedArtists(
            user: $user,
            offset: $offset
        );
    }

    private function getUsers(User $user, int $offset): UserMediaListDTO
    {
        return $this->users->getFollowedUsers(
            user: $user,
            offset: $offset
        );
    }
}
