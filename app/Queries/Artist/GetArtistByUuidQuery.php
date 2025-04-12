<?php

declare(strict_types=1);

namespace App\Queries\Artist;

use App\Models\Artist;

final class GetArtistByUuidQuery
{
    public function execute(string $uuid): Artist|null
    {
        return Artist::query()->where("uuid", $uuid)->first();
    }
}
