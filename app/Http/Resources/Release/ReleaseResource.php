<?php

declare(strict_types=1);

namespace App\Http\Resources\Release;

use App\Http\Resources\Artist\CompactArtistResource;
use App\Models\Release;
use App\Services\AuthService;
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
        $isFollowed = AuthService::check() && $this->is_followed !== null;

        $tracks = $this->tracks->pluck("uuid")->toArray();

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,

            "like_count" => $this->like_count,
            "track_count" => $this->track_count,

            "artists" => CompactArtistResource::collection($this->artists),
            "tracks" => $tracks,

            "type" => $this->type,
            "release_date" => $this->release_date,
        ];
    }
}
