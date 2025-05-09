<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin User
 */
final class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFollowed = Auth::check() && $this->is_followed !== null;

        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,

            "followed_artists_count" => $this->followed_artists_count,
            "followed_users_count" => $this->followed_users_count,
            "followers_count" => $this->followers_count
        ];
    }
}
