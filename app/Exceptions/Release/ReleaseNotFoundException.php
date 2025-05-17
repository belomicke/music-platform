<?php

namespace App\Exceptions\Release;

use Exception;
use Illuminate\Http\JsonResponse;

class ReleaseNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "Release not found."
        ], 404);
    }
}
