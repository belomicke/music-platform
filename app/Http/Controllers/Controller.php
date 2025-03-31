<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function success(array $data = []): JsonResponse
    {
        $json = [
            "success" => true
        ];

        if (!empty($data)) {
            $json["data"] = $data;
        }

        return response()->json($json);
    }

    public function error(
        string $message = "Internal Server Error",
        int    $code = 500
    ): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => $message
        ], $code);
    }
}
