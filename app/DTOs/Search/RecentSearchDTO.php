<?php

declare(strict_types=1);

namespace App\DTOs\Search;

use App\Models\Artist;
use App\Models\Release;

final class RecentSearchDTO
{
    public function __construct(
        public Artist|Release $data,
        public string         $type
    ) {}
}
