<?php

declare(strict_types=1);

namespace App\Actions\Player;

use App\DTOs\Player\PlayerStateDTO;
use App\Exceptions\Track\TrackNotFoundException;
use App\Services\PlayerService;

final readonly class GetPlayerStateAction
{
    public function __construct(
        private PlayerService $playerService,
    ) {}

    /**
     * @throws TrackNotFoundException
     */
    public function execute(): PlayerStateDTO
    {
        return $this->playerService->getPlayerState();
    }
}
