<?php

declare(strict_types=1);

namespace App\Http\Controllers\Collection;

use App\Actions\Collection\GetFavoriteArtistsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\GetFavoriteArtistsRequest;
use App\Http\Resources\Artist\CompactArtistResource;
use Illuminate\Http\JsonResponse;

final class GetFavoriteArtistsController extends Controller
{
    public function __invoke(
        GetFavoriteArtistsRequest $request,
        GetFavoriteArtistsAction  $getFavoriteArtistsAction
    ): JsonResponse
    {
        $offset = (int)$request->input("offset", 0);

        $result = $getFavoriteArtistsAction->execute(
            offset: $offset
        );

        return $this->success([
            "artists" => CompactArtistResource::collection($result->artists),
            "count" => $result->count
        ]);
    }
}
