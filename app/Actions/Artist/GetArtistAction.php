<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Models\Artist;
use App\Services\ArtistService;

final readonly class GetArtistAction
{
    /**
     * @throws ArtistNotFoundException
     */
    public function execute(string $uuid): Artist
    {
        return ArtistService::getByUuid(
            uuid: $uuid,
            relationsIfAuth: [
                "is_followed",
            ]
        );
    }
}
