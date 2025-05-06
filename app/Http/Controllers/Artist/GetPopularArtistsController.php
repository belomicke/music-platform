<?php

declare(strict_types=1);

namespace App\Http\Controllers\Artist;

use App\Actions\Artist\GetPopularArtistsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artist\CompactArtistResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetPopularArtistsController extends Controller
{
    public function __invoke(
        Request                 $request,
        GetPopularArtistsAction $getPopularArtistsAction
    ): JsonResponse
    {
        $data = $getPopularArtistsAction->execute();

        return $this->success([
            "artists" => CompactArtistResource::collection($data->artists),
            "count" => $data->count,
        ]);
    }
}
