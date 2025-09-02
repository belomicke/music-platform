<?php

declare(strict_types=1);

namespace App\Modules\Collection\Actions;

use App\DTOs\Release\ReleaseMediaListDTO;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Collection\Services\CollectionService;

final readonly class GetFavoriteReleasesAction
{
    public function execute(int $offset = 0): ReleaseMediaListDTO
    {
        $releases = CollectionService::getFavoriteReleases(offset: $offset);
        $count = AuthService::user()->followed_releases_count;

        return new ReleaseMediaListDTO(
            releases: $releases,
            count: $count
        );
    }
}
