<?php

declare(strict_types=1);

namespace App\Actions\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Models\Artist;
use App\Queries\Artist\GetArtistByUuidQuery;

final readonly class GetArtistByUuidAction
{
    public function __construct(
        private GetArtistByUuidQuery $getArtistByUuidQuery
    ) {}

    /**
     * @throws ArtistNotFoundException
     */
    public function execute(string $uuid): Artist
    {
        $artist = $this->getArtistByUuidQuery->execute(uuid: $uuid);

        if ($artist === null) {
            throw new ArtistNotFoundException();
        }

        return $artist;
    }
}
