<?php

declare(strict_types=1);

namespace App\Actions\Release;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\Release;
use App\Services\ReleaseService;

final readonly class GetReleaseAction
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function execute(string $uuid): Release
    {
        return ReleaseService::getByUuid(
            uuid: $uuid,
            relations: [
                "artists"
            ],
            relationsIfAuth: [
                "is_followed",
                "artists.is_followed"
            ]
        );
    }
}
