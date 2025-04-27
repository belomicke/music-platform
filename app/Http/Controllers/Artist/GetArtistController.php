<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\ArtistResource;
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

        return $this->success([
            "artist" => ArtistResource::make($artist)
        ]);
    }
}
