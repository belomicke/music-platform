<?php

declare(strict_types=1);

namespace App\Modules\Release\Actions;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Models\Release;
use App\Modules\Release\Service\ReleaseService;

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
