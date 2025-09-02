<?php

declare(strict_types=1);

namespace App\Modules\Release\Http\Controllers;

use App\Exceptions\Artist\ArtistNotFoundException;
use App\Http\Controllers\Controller;
use App\Modules\Release\Actions\GetArtistReleasesAction;
use App\Modules\Release\Http\Resources\ReleaseResource;
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
