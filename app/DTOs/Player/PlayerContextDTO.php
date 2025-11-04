<?php

namespace App\DTOs\Player;

class PlayerContextDTO
{
    public function __construct(
        public int    $id,
        public string $type,
    ) {}
}
