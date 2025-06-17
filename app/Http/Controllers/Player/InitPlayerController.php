<?php

declare(strict_types=1);

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Http\Resources\Track\TrackResource;
use App\Repositories\PlayerRepository;
use App\Repositories\TrackRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class InitPlayerController extends Controller
{
    public function __construct(
        private readonly TrackRepository  $tracks,
        private readonly PlayerRepository $player,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        $contextId = $this->player->getContextId();
        $position = $this->player->getPosition();
        $trackId = $this->player->getTrackId();
        $length = $this->player->getLength();

        if ($trackId !== null) {
            $track = $this->tracks->getByUUID(uuid: $trackId);

            $track = TrackResource::make($track);
        } else {
            $track = null;
        }

        return $this->success([
            "context_id" => $contextId,
            "position" => $position,
            "track_id" => $trackId,
            "length" => $length,
            "track" => $track,
        ]);
    }
}
