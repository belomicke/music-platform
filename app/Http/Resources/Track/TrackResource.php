<?php

declare(strict_types=1);

namespace App\Http\Resources\Track;

use App\Http\Resources\Artist\CompactArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use App\Models\Track;
use App\Services\AuthService;
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
        $isFavorite = AuthService::check() && $this->is_favorite !== null;

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "duration_ms" => $this->duration_ms,

            "is_favorite" => $isFavorite,

            "artists" => CompactArtistResource::collection($this->artists),
            "releases" => ReleaseResource::collection($this->releases)
        ];
    }
}
