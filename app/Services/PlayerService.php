<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\Player\PlayerStateDTO;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Exceptions\Track\TrackNotFoundException;
use App\Models\Track;
use App\Repositories\PlayerRepository;
use Illuminate\Database\Eloquent\Collection;

class PlayerService
{
    public function __construct(
        public PlayerRepository $player
    ) {}

    /**
     * @throws TrackNotFoundException
     */
    public function getPlayerState(): PlayerStateDTO
    {
        $state = $this->player->getPlayerState();

        $trackId = $this->player->getTrackId();

        $track = TrackService::getByUuid(
            uuid: $trackId,
            relations: [
                "release",
                "artists",
            ],
            relationsIfAuth: [
                "is_favorite"
            ]
        );

        $state->track = $track;

        return $state;
    }

    /**
     * @throws ReleaseNotFoundException
     * @throws TrackNotFoundException
     */
    public function setNextTrack(): PlayerStateDTO
    {
        $state = $this->player->getPlayerState();

        $position = $state->position;
        $length = $state->length;

        if ($position + 1 > $length) {
            $position = 1;
            $this->player->setPosition(position: 1);
        } else {
            $position = $position + 1;
            $this->player->setPosition(position: $position);
        }

        $nextTrack = $this->getTrackFromCurrentQueue($position);

        $state->track = $nextTrack;

        return $this->getPlayerState();
    }

    /**
     * @throws ReleaseNotFoundException
     * @throws TrackNotFoundException
     */
    public function setPreviousTrack(): PlayerStateDTO
    {
        $state = $this->player->getPlayerState();

        $position = $state->position;
        $length = $state->length;

        if ($position - 1 === 0) {
            $position = $length;
            $this->player->setPosition(position: $length);
        } else {
            $position = $position - 1;
            $this->player->setPosition(position: $position);
        }

        $nextTrack = $this->getTrackFromCurrentQueue($position);

        $state->track = $nextTrack;

        return $this->getPlayerState();
    }

    /**
     * @throws ReleaseNotFoundException
     */
    private function getTrackFromCurrentQueue(int $position): Track
    {
        $queue = $this->getCurrentQueue();

        $track = $queue->get(key: $position - 1);

        $this->player->setTrackId(id: $track->uuid);

        return $track;
    }

    /**
     * @return Collection<Track>
     * @throws ReleaseNotFoundException
     *
     */
    private function getCurrentQueue(): Collection
    {
        $state = $this->player->getPlayerState();

        $context = $this->player->getContextId();

        $contextId = explode(":", $context)[1];
        $contextType = explode(":", $context)[0];

        if ($contextType === "release") {
            $release = ReleaseService::getByUuid(uuid: $contextId);

            return Track::query()
                ->where('release_id', $release->id)
                ->orderBy('id')
                ->get();
        }
    }
}
