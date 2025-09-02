<?php

declare(strict_types=1);

namespace App\Modules\Follow\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

final class ReleaseAlreadyFollowedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "Release already followed."
        ], 409);
    }
}
