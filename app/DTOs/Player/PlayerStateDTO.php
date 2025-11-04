<?php

declare(strict_types=1);

namespace App\DTOs\Player;

use App\Http\Resources\TrackResource;
use App\Models\Track;

class PlayerStateDTO
{
    public function __construct(
        public string     $contextId,
        public int        $position,
        public int        $length,
        public string     $repeat_state,
        public int        $volume,
        public Track|null $track,
    ) {}

    public function toArray(): array
    {
        return [
            "context_id" => $this->contextId,
            "position" => $this->position,
            "length" => $this->length,
            "repeat_state" => $this->repeat_state,
            "volume" => $this->volume,
            "track" => TrackResource::make($this->track),
        ];
    }
}
