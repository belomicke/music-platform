<?php

declare(strict_types=1);

namespace App\Exceptions\Track;

use Exception;
use Illuminate\Http\JsonResponse;

final class TrackNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "Track not found.",
        ], 404);
    }
}
