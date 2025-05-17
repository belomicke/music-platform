<?php

declare(strict_types=1);

namespace App\DTOs\RecentSearch;

final class RecentSearchDTO
{
    public function __construct(
        public mixed  $data,
        public string $type
    ) {}
}
