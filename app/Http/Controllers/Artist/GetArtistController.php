<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Release\ReleaseResource;
use App\Models\Artist;
use Illuminate\Http\JsonResponse;

final class GetArtistController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(
        Artist $artist,
    ): JsonResponse
    {
        if ($artist->exists === false) {
            throw new ArtistNotFoundException();
        }

        $artist->load(relations: [
            "releases",
            "releases.is_followed",
            "releases.artists",
            "releases.artists.is_followed",
            "releases.tracks",
        ]);

        return $this->success([
            "artist" => ArtistResource::make($artist),
            "releases" => [
                "items" => ReleaseResource::collection($artist->releases),
                "count" => $artist->releases()->count()
            ]
        ]);
    }
}
