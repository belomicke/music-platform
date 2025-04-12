<?php

declare(strict_types=1);

namespace App\Http\Resources\Artist;

use App\Models\Artist;
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
        return [
            "id" => $this->uuid,
            "name" => $this->name,
            "followers" => [
                "total" => $this->followers_count
            ],
            "images" => [
                "640" => [
                    "url" => "/storage/artists/images/avatar/640/$this->uuid.jpeg",
                    "width" => 640,
                    "height" => 640,
                ],
            ]
        ];
    }
}
