<?php

declare(strict_types=1);

namespace App\Http\Resources\Artist;

use App\Models\Artist;
use App\Services\AuthService;
use App\Services\Cache\ArtistCacheService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Artist
 */
final class ArtistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isFollowed = $this->getIsFollowed();

        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,
        ];
    }

    private function getIsFollowed(): bool
    {
        if (AuthService::check() === false) {
            return false;
        }
        
        return ArtistCacheService::getIsFollowed(
            id: $this->id,
            default: function () {
                $value = $this->is_followed !== null;

                ArtistCacheService::setIsFollowed(
                    id: $this->id,
                    value: $value
                );

                return $value;
            }
        );
    }
}
