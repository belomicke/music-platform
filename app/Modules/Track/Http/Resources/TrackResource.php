<?php

declare(strict_types=1);

namespace App\Modules\Track\Http\Resources;

use App\Models\Track;
use App\Modules\Artist\Http\Resources\ArtistResource;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Release\Http\Resources\ReleaseResource;
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
        $isFavorite = AuthService::check() && !($this->is_favorite === null);

        $artists = $this->artists;
        $release = $this->release;

        return [
            "id" => $this->uuid,
            "title" => $this->title,
            "duration_ms" => $this->duration_ms,

            "is_favorite" => $isFavorite,

            "release" => ReleaseResource::make($release),
            "artists" => ArtistResource::collection($artists),
        ];
    }
}
