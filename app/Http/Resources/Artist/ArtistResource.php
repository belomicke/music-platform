<?php

declare(strict_types=1);

namespace App\Http\Resources\Artist;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin Artist
 */
final class ArtistResource extends JsonResource
{
    public $with = ["is_followed"];

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
            "followers_count" => $this->followers_count,
        ];
    }
}
