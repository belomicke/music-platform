<?php

declare(strict_types=1);

namespace App\Http\Controllers\Release;

use App\Actions\Release\GetArtistReleasesAction;
use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetArtistReleasesController extends Controller
{
    /**
     * @throws ArtistNotFoundException
     */
    public function __invoke(
        string                  $uuid,
        GetArtistReleasesAction $getArtistReleasesAction
    ): JsonResponse
    {
        $data = $getArtistReleasesAction->execute(uuid: $uuid);

        return $this->success([
            "releases" => ReleaseResource::collection(resource: $data->releases),
            "count" => $data->count,
        ]);
    }
}
