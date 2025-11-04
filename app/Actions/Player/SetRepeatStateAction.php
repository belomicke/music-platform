<?php

declare(strict_types=1);

namespace App\Actions\Player;

use App\Repositories\PlayerRepository;

final readonly class SetRepeatStateAction
{
    public function __construct(
        private PlayerRepository $player
    ) {}

    public function execute(string $state): void
    {
        $this->player->setRepeatState($state);
    }
}
