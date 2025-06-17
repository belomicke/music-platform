<?php

declare(strict_types=1);

namespace App\Http\Resources\Release;

use App\Http\Resources\Artist\ArtistResource;
use App\Models\Release;
use App\Services\AuthService;
use App\Services\Cache\ReleaseCacheService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Release
 */
final class ReleaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFollowed = $this->getIsFollowed();
        $artists = $this->getArtists();
        $tracks = $this->getTracks()->pluck(value: "uuid")->toArray();

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,

            "like_count" => $this->like_count,
            "track_count" => $this->track_count,

            "artists" => ArtistResource::collection($artists),
            "tracks" => $tracks,

            "type" => $this->type,
            "release_date" => $this->release_date,
        ];
    }

    private function getIsFollowed(): bool
    {
        if (AuthService::check() === false) {
            return false;
        }

        return ReleaseCacheService::getIsFollowed(
            id: $this->id,
            default: function () {
                $value = $this->is_followed !== null;

                ReleaseCacheService::setIsFollowed(
                    id: $this->id,
                    value: $value
                );

                return $value;
            }
        );
    }

    private function getArtists(): Collection
    {
        return ReleaseCacheService::getArtists(
            id: $this->uuid,
            default: function () {
                $artists = $this->artists;

                ReleaseCacheService::setArtists(
                    id: $this->uuid,
                    value: $artists
                );

                return $artists;
            }
        );
    }

    private function getTracks(): Collection
    {
        return ReleaseCacheService::getTracks(
            id: $this->uuid,
            default: function () {
                $tracks = $this->tracks;

                ReleaseCacheService::setTracks(
                    id: $this->uuid,
                    value: $tracks
                );

                return $tracks;
            }
        );
    }
}
