<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

final class ExpiredPasswordResetTokenException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "Expired token."
        ], 400);
    }
}
