<?php

declare(strict_types=1);

namespace App\Modules\Artist\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Artist\Actions\GetPopularArtistsAction;
use App\Modules\Artist\Http\Resources\ArtistResource;
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
            "artists" => ArtistResource::collection(resource: $data->artists),
            "count" => $data->count,
        ]);
    }
}
