<?php

declare(strict_types=1);

namespace App\Modules\Release\Http\Controllers;

use App\Exceptions\Release\ReleaseNotFoundException;
use App\Http\Controllers\Controller;
use App\Modules\Release\Actions\GetReleaseAction;
use App\Modules\Release\Http\Resources\ReleaseResource;
use Illuminate\Http\JsonResponse;

final class GetReleaseController extends Controller
{
    /**
     * @throws ReleaseNotFoundException
     */
    public function __invoke(
        string           $uuid,
        GetReleaseAction $getReleaseAction
    ): JsonResponse
    {
        $release = $getReleaseAction->execute(uuid: $uuid);

        return $this->success([
            "release" => ReleaseResource::make($release),
        ]);
    }
}
