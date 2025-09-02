<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class ValidUuidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (array_key_exists("uuid", $request->route()->parameters())) {
            $uuid = $request->route()->parameter("uuid");

            if (Str::isUuid($uuid) === false) {
                return response()->json([
                    "success" => false,
                    "message" => "Invalid uuid.",
                ], 400);
            }
        }
        
        return $next($request);
    }
}
