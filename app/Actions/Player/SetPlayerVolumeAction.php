<?php

declare(strict_types=1);

namespace App\Actions\Player;

use App\Repositories\PlayerRepository;

final readonly class SetPlayerVolumeAction
{
    public function __construct(
        private PlayerRepository $player
    ) {}

    public function execute(int $volume): void
    {
        $this->player->setVolume(volume: $volume);
    }
}
