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
            "image_url" => "/storage/artists/images/avatar/640/$this->uuid.jpeg",
            "is_followed" => false,

            "followed_artists_count" => $this->followed_artists_count,
            "followed_users_count" => $this->followed_users_count,
            "followers_count" => $this->followers_count,

            "email" => $this->email,
        ];
    }
}
