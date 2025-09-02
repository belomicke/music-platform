<?php

declare(strict_types=1);

namespace App\Modules\Artist\Http\Resources;

use App\Models\Artist;
use App\Modules\Auth\Services\AuthService;
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
        $isFollowed = AuthService::check() && !($this->is_followed === null);

        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "image_url" => $this->image_url,
            "is_followed" => $isFollowed,
        ];
    }
}
