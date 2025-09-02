<?php

declare(strict_types=1);

namespace App\Modules\Player\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Player\Actions\GetPlayerStateAction;
use Illuminate\Http\JsonResponse;

final class GetPlayerStateController extends Controller
{
    public function __invoke(
        GetPlayerStateAction $getPlayerStateAction
    ): JsonResponse
    {
        $result = $getPlayerStateAction->execute();

        return $this->success($result);
    }
}
