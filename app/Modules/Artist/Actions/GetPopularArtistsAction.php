<?php

declare(strict_types=1);

namespace App\Modules\Artist\Actions;

use App\DTOs\Artist\ArtistMediaListDTO;
use App\Modules\Artist\Repositories\ArtistRepository;

final readonly class GetPopularArtistsAction
{
    public function execute(): ArtistMediaListDTO
    {
        return ArtistRepository::getPopular();
    }
}
