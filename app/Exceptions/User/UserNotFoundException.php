<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use Exception;
use Illuminate\Http\JsonResponse;

final class UserNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "User not found."
        ], 404);
    }
}
