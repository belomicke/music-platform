<?php

declare(strict_types=1);

namespace App\Modules\Player\Actions;

use App\Exceptions\Track\TrackNotFoundException;
use App\Modules\Player\Repositories\PlayerRepository;
use App\Modules\Track\Http\Resources\TrackResource;
use App\Modules\Track\Services\TrackService;

final readonly class GetPlayerStateAction
{
    public function __construct(
        private PlayerRepository $player,
    ) {}

    public function execute(): array
    {
        $contextId = $this->player->getContextId();
        $position = $this->player->getPosition();
        $trackId = $this->player->getTrackId();
        $length = $this->player->getLength();
        $track = $this->getTrack(track_id: $trackId);

        return [
            "context_id" => $contextId,
            "position" => $position,
            "track_id" => $trackId,
            "length" => $length,
            "track" => $track,
        ];
    }

    /**
     * @throws TrackNotFoundException
     */
    private function getTrack(string|null $track_id): TrackResource|null
    {
        if ($track_id !== null) {
            $track = TrackService::getByUuid(
                uuid: $track_id,
                relations: [
                    "artists",
                    "release",
                    "release.artists"
                ],
                relationsIfAuth: [
                    "is_favorite",
                    "artists.is_followed",
                    "release.is_followed",
                    "release.artists.is_followed"
                ]
            );

            return TrackResource::make($track);
        } else {
            return null;
        }
    }
}
