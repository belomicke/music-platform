<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Models\User;
use App\Repositories\UserRepository;

final readonly class GetUserFollowedArtistsAction
{
    public function __construct(
        private UserRepository $users
    ) {}

    public function execute(User $user, int $offset): ArtistMediaListDTO
    {
        return $this->users->getFollowedArtists(
            user: $user,
            offset: $offset
        );
    }
}
