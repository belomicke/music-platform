<?php

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\GetPopularArtistsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\ArtistResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetPopularArtists extends Controller
{
    public function __invoke(
        Request                 $request,
        GetPopularArtistsAction $getPopularArtistsAction
    ): JsonResponse
    {
        $artists = $getPopularArtistsAction->execute();

        return $this->success([
            "artists" => ArtistResource::collection(resource: $artists)
        ]);
    }
}
