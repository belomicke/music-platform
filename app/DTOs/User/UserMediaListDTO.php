<?php

declare(strict_types=1);

namespace App\DTOs\User;

use App\Models\User;
use Illuminate\Support\Collection;

final class UserMediaListDTO
{
    /**
     * @var Collection<User> $users
     */
    public function __construct(
        public Collection $users,
        public int        $count
    ) {}
}
