<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Release;
use App\Services\AuthService;
use App\Services\Cache\ReleaseCacheService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

final class ReleaseRepository
{
    public function getByUUID(string $uuid): Release|null
    {
        return Cache::get(
            key: "release:$uuid",
            default: function () use ($uuid) {
                $release = Release::query()
                    ->where('uuid', $uuid)
                    ->first();

                Cache::set(
                    key: "release:$uuid",
                    value: $release
                );

                return $release;
            }
        );
    }

    public function getTracks(string $uuid): Collection
    {
        $release = $this->getByUUID(uuid: $uuid);

        return ReleaseCacheService::getTracks(
            id: $uuid,
            default: function () use ($release) {
                $tracks = $release->tracks;

                ReleaseCacheService::setTracks(
                    id: $release->uuid,
                    value: $tracks
                );

                return $tracks;
            }
        );
    }

    public function getReleaseTrack(string $uuid, int $position): array
    {
        return Cache::get(
            key: "release:$uuid:tracks:$position",
            default: function () use ($uuid, $position) {
                $release = $this->getByUUID(uuid: $uuid);

                $track = $release
                    ->tracks()
                    ->skip(value: $position - 1)
                    ->first();

                $result = [
                    $track,
                    $release->track_count
                ];

                Cache::set(
                    key: "release:$uuid:track-list:$position",
                    value: $result
                );

                return $result;
            }
        );
    }

    public function getManyByUUID(array $uuids): Collection
    {
        return Release::query()
            ->whereIn('uuid', $uuids)
            ->get();
    }

    public function search(string $query, int $limit = 36): Collection
    {
        return Release::search(query: $query)
            ->take(limit: $limit)
            ->get();
    }

    public function follow(Release $release): void
    {
        AuthService::user()
            ->followed_releases()
            ->attach($release);
    }

    public function unfollow(Release $release): void
    {
        AuthService::user()
            ->followed_releases()
            ->detach($release);
    }
}
