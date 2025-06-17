<?php

declare(strict_types=1);

namespace App\Http\Resources\Track;

use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use App\Models\Track;
use App\Services\AuthService;
use App\Services\Cache\TrackCacheService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Track
 */
final class TrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFavorite = $this->getIsFavorite();

        $artists = $this->getArtists();
        $releases = $this->getReleases();

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "duration_ms" => $this->duration_ms,

            "is_favorite" => $isFavorite,

            "artists" => ArtistResource::collection($artists),
            "releases" => ReleaseResource::collection($releases)
        ];
    }

    private function getIsFavorite(): bool
    {
        if (AuthService::check() === false) {
            return false;
        }

        return TrackCacheService::getIsFavorite(
            id: $this->id,
            default: function () {
                $value = $this->is_favorite !== null;

                TrackCacheService::setIsFavorite(
                    id: $this->id,
                    value: $value
                );

                return $value;
            }
        );
    }

    private function getArtists(): Collection
    {
        return TrackCacheService::getArtists(
            id: $this->uuid,
            default: function () {
                $artists = $this->artists;

                TrackCacheService::setArtists(
                    id: $this->uuid,
                    value: $artists
                );

                return $artists;
            }
        );
    }

    private function getReleases(): Collection
    {
        return TrackCacheService::getReleases(
            id: $this->uuid,
            default: function () {
                $releases = $this->releases;

                TrackCacheService::setReleases(
                    id: $this->uuid,
                    value: $releases
                );

                return $releases;
            }
        );
    }
}
