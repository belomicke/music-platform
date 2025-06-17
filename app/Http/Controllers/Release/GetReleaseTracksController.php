<?php

declare(strict_types=1);

namespace App\Http\Controllers\Release;

use App\Actions\Release\GetReleaseTracksAction;
use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Track\TrackResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetReleaseTracksController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        Request                $request,
        string                 $releaseId,
        GetReleaseTracksAction $getReleaseTracksAction
    ): JsonResponse
    {
        $result = $getReleaseTracksAction->execute(uuid: $releaseId);

        return $this->success([
            "tracks" => TrackResource::collection($result->tracks),
            "count" => $result->count
        ]);
    }
}
