<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Services\AuthService;
use App\Services\CollectionService;

final readonly class GetFavoriteArtistsAction
{
    /**
     * @throws ArtistNotFoundException
     */
    public function execute(string $after = ""): ArtistMediaListDTO
    {
        $artists = CollectionService::getFavoriteArtists(after: $after);
        $count = AuthService::user()->favorite_artists_count;

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }
}
