<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Release;
use App\Services\AuthService;
use Illuminate\Database\Eloquent\Collection;

final class ReleaseRepository
{
    public function getByUUID(string $uuid): Release|null
    {
        return Release::query()->where('uuid', $uuid)->first();
    }

    public function getManyByUUID(array $uuids): Collection
    {
        return Release::query()->whereIn('uuid', $uuids)->get();
    }

    public function search(string $query, int $limit = 36): Collection
    {
        return Release::search(query: $query)->take(limit: $limit)->get();
    }

    public function follow(Release $release): void
    {
        AuthService::user()->followed_releases()->attach($release);
    }

    public function unfollow(Release $release): void
    {
        AuthService::user()->followed_releases()->detach($release);
    }
}
