<?php

declare(strict_types=1);

namespace App\DTOs\Release;

use App\Models\Release;
use Illuminate\Support\Collection;

final class ReleaseMediaListDTO
{
    /**
     * @var Collection<Release> $releases
     */
    public function __construct(
        public Collection $releases,
        public int        $count
    ) {}
}
