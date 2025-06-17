<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Services\AuthService;
use Illuminate\Support\Facades\Cache;

final class PlayerRepository
{
    public function getTrackId(): string|null
    {
        $user = AuthService::user();

        return Cache::get(key: "player:$user->id:track-id");
    }

    public function setTrackId(string $id): void
    {
        $user = AuthService::user();

        Cache::set(key: "player:$user->id:track-id", value: $id);
    }

    public function getContextId(): string|null
    {
        $user = AuthService::user();

        return Cache::get(key: "player:$user->id:context-id");
    }

    public function setContextId(string $id): void
    {
        $user = AuthService::user();

        Cache::set(key: "player:$user->id:context-id", value: $id);
    }

    public function getPosition(): int|null
    {
        $user = AuthService::user();

        return (int)Cache::get(key: "player:$user->id:position");
    }

    public function setPosition(int $position): void
    {
        $user = AuthService::user();

        Cache::set(key: "player:$user->id:position", value: $position);
    }

    public function getLength(): int|null
    {
        $user = AuthService::user();

        return (int)Cache::get(key: "player:$user->id:length");
    }

    public function setLength(int $length): void
    {
        $user = AuthService::user();

        Cache::set(key: "player:$user->id:length", value: $length);
    }
}
