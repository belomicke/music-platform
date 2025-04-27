<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Models\User;
use App\Repositories\ArtistRepository;

final readonly class GetUserFollowedArtistsAction
{
    public function __construct(
        private ArtistRepository $artists
    ) {}

    public function execute(User $user, int $offset): ArtistMediaListDTO
    {
        return $this->artists->getUserFollowed(
            user: $user,
            offset: $offset
        );
    }
}
