<?php

declare(strict_types=1);

namespace App\Modules\Collection\Http\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Artist\Http\Resources\ArtistResource;
use App\Modules\Collection\Actions\GetFavoriteArtistsAction;
use App\Modules\Collection\Http\Requests\GetMediaListRequest;
use Illuminate\Http\JsonResponse;

final class GetFavoriteArtistsController extends Controller
{
    public function __invoke(
        GetMediaListRequest      $request,
        GetFavoriteArtistsAction $getFavoriteArtistsAction
    ): JsonResponse
    {
        $offset = (int)$request->input("offset", 0);

        $result = $getFavoriteArtistsAction->execute(
            offset: $offset
        );

        return $this->success([
            "artists" => ArtistResource::collection($result->artists),
            "count" => $result->count
        ]);
    }
}
