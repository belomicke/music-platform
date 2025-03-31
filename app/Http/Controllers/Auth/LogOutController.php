<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LogOutAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class LogOutController extends Controller
{
    public function __invoke(
        Request      $request,
        LogOutAction $logOutAction
    ): JsonResponse
    {
        $logOutAction->execute(request: $request);

        return $this->success();
    }
}
