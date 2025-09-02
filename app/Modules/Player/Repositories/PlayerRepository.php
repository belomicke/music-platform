<?php

declare(strict_types=1);

namespace App\Modules\Player\Repositories;

use App\Modules\Auth\Services\AuthService;
use Illuminate\Support\Facades\Cache;

final class PlayerRepository
{
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
}
