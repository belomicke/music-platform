<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteArtistsAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Collection\GetMediaListRequest;
use App\Http\Resources\ArtistResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteArtistsController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(
        GetMediaListRequest      $request,
        GetFavoriteArtistsAction $getFavoriteArtistsAction
    ): JsonResponse
    {
        $after = $request->input("after", "");

        $result = $getFavoriteArtistsAction->execute(
            after: $after
        );

        return $this->success([
            "artists" => ArtistResource::collection($result->artists),
            "count" => $result->count
        ]);
    }
}
