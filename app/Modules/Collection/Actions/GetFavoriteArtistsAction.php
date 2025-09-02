<?php

declare(strict_types=1);

namespace App\Modules\Collection\Actions;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Collection\Repositories\CollectionRepository;

final readonly class GetFavoriteArtistsAction
{
    public function execute(int $offset = 0): ArtistMediaListDTO
    {
        $artists = CollectionRepository::getFavoriteArtists(offset: $offset);
        $count = AuthService::user()->followed_artists_count;

        return new ArtistMediaListDTO(
            artists: $artists,
            count: $count
        );
    }
}
