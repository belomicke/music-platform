<?php

declare(strict_types=1);

namespace App\Modules\Release\Http\Resources;

use App\Models\Release;
use App\Modules\Artist\Http\Resources\ArtistResource;
use App\Modules\Auth\Services\AuthService;
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
        $isFollowed = AuthService::check() && !($this->is_followed === null);
        $artists = $this->artists;

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,

            "like_count" => $this->like_count,
            "track_count" => $this->track_count,

            "artists" => ArtistResource::collection($artists),

            "type" => $this->type,
            "release_date" => $this->release_date,
        ];
    }
}
