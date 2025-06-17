<?php

declare(strict_types=1);

namespace App\Http\Controllers\Player;

use App\Actions\Player\SetTrackAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SetTrackController extends Controller
{
    public function __invoke(
        Request        $request,
        SetTrackAction $setTrackAction
    ): JsonResponse
    {
        $contextId = $request->input('context_id');
        $position = (int)$request->input('position');

        try {
            $result = $setTrackAction->execute(
                contextId: $contextId,
                position: $position
            );

            return $this->success($result);
        } catch (Exception $e) {
            return $this->error(message: $e->getMessage());
        }
    }
}
