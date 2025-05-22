<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
final class CurrentUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "image_url" => $this->image_url,
            "email" => $this->email,
            "followed_artists_count" => $this->followed_artists_count,
            "followed_releases_count" => $this->followed_releases_count,
            "favorite_tracks_count" => $this->favorite_tracks_count
        ];
    }
}
