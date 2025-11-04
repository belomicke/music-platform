<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Repositories\ArtistRepository;

final readonly class GetPopularArtistsAction
{
    public function execute(): ArtistMediaListDTO
    {
        return ArtistRepository::getPopular();
    }
}
