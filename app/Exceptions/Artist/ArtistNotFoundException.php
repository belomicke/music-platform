<?php

declare(strict_types=1);

namespace App\Exceptions\Artist;

use Exception;
use Illuminate\Http\JsonResponse;

final class ArtistNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            "success" => false,
            "message" => "Artist not found."
        ], 404);
    }
}
