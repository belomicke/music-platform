<?php

declare(strict_types=1);

namespace App\Actions\Collection;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Services\AuthService;
use App\Services\CollectionService;

final readonly class GetFavoriteReleasesAction
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function execute(string $after = ""): ReleaseMediaListDTO
    {
        $releases = CollectionService::getFavoriteReleases(after: $after);
        $count = AuthService::user()->favorite_releases_count;

        return new ReleaseMediaListDTO(
            releases: $releases,
            count: $count
        );
    }
}
