<?php

declare(strict_types=1);

namespace App\Actions\Player;

use App\Http\Resources\Track\TrackResource;
use App\Repositories\PlayerRepository;
use App\Repositories\ReleaseRepository;
use App\Services\AuthService;
use Exception;

readonly class SetTrackAction
{
    public function __construct(
        private PlayerRepository  $player,
        private ReleaseRepository $releases,
    ) {}

    /**
     * @throws Exception
     */
    public function execute(string $contextId, int $position): array
    {
        $this->player->setContextId(id: $contextId);
        $this->player->setPosition(position: $position);

        if (str_starts_with($contextId, "release")) {
            return $this->setReleaseTrack(
                context_id: $contextId,
                position: $position
            );
        } else if ($contextId === "favorite-tracks") {
            return $this->setFavoriteTrack(
                context_id: $contextId,
                position: $position
            );
        }

        throw new Exception("Incorrect context_id.");
    }

    private function setReleaseTrack(string $context_id, int $position): array
    {
        $releaseId = explode(":", $context_id)[1];
        [$track, $length] = $this->releases->getReleaseTrack(
            uuid: $releaseId,
            position: $position
        );

        $this->player->setTrackId(id: $track->uuid);
        $this->player->setLength(length: $length);

        return [
            "context_id" => $context_id,
            "position" => $position,
            "track_id" => $track->uuid,
            "length" => $length,
            "track" => TrackResource::make($track)
        ];
    }

    private function setFavoriteTrack(string $context_id, int $position): array
    {
        $user = AuthService::user();

        $track = $user
            ->favorite_tracks()
            ->orderByPivot(
                column: "id",
                direction: "desc"
            )
            ->skip(value: $position - 1)
            ->first();
        $length = $user->favorite_tracks_count;

        $this->player->setTrackId(id: $track->uuid);
        $this->player->setLength(length: $length);

        return [
            "context_id" => $context_id,
            "position" => $position,
            "track_id" => $track->uuid,
            "length" => $length,
            "track" => TrackResource::make($track)
        ];
    }
}
