<?php

declare(strict_types=1);

namespace App\Modules\Artist\Actions;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Models\Artist;
use App\Modules\Artist\Services\ArtistService;

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
