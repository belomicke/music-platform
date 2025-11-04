<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Player\PlayerStateDTO;
use App\Services\AuthService;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

final class PlayerRepository
{
    public function getPlayerState(): PlayerStateDTO
    {
        return new PlayerStateDTO(
            contextId: $this->getContextId(),
            position: $this->getPosition(),
            length: $this->getLength(),
            repeat_state: $this->getRepeatState(),
            volume: $this->getVolume(),
            track: null
        );
    }

    public function getTrackId(): string|null
    {
        $user = AuthService::user();

        return Cache::get(key: "user:$user->id:player:track-id");
    }

    public function setTrackId(string $id): void
    {
        $user = AuthService::user();

        Cache::set(key: "user:$user->id:player:track-id", value: $id);
    }

    public function getContextId(): string|null
    {
        $user = AuthService::user();

        return Cache::get(key: "user:$user->id:player:context-id");
    }

    public function setContextId(string $id): void
    {
        $user = AuthService::user();

        Cache::set(key: "user:$user->id:player:context-id", value: $id);
    }

    public function getPosition(): int|null
    {
        $user = AuthService::user();

        return (int)Cache::get(key: "user:$user->id:player:position");
    }

    public function setPosition(int $position): void
    {
        $user = AuthService::user();

        Cache::set(key: "user:$user->id:player:position", value: $position);
    }

    public function getLength(): int|null
    {
        $user = AuthService::user();

        return (int)Cache::get(key: "user:$user->id:player:length");
    }

    public function setLength(int $length): void
    {
        $user = AuthService::user();

        Cache::set(key: "user:$user->id:player:length", value: $length);
    }

    public function getRepeatState(): string
    {
        $user = AuthService::user();

        return Cache::get(key: "user:$user->id:player:repeat-state") ?? "off";
    }

    public function setRepeatState(string $repeat_state): void
    {
        $user = AuthService::user();

        if (!in_array($repeat_state, ['off', 'track', 'context'])) {
            throw new InvalidArgumentException("Invalid repeat state.");
        }

        Cache::set(key: "user:$user->id:player:repeat-state", value: $repeat_state);
    }

    public function getVolume(): int
    {
        $user = AuthService::user();

        return (int)Cache::get(key: "user:$user->id:player:volume") ?? 50;
    }

    public function setVolume(int $volume): void
    {
        $user = AuthService::user();

        Cache::set(key: "user:$user->id:player:volume", value: $volume);
    }
}
