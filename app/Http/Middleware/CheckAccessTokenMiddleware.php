<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

final class CheckAccessTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header("Authorization");

        if (empty($token)) {
            return $next($request);
        }

        $bearer = str_replace('Bearer ', '', $token);
        $bearer = explode('|', $bearer)[1];

        $token = PersonalAccessToken::query()
            ->where("token", hash('sha256', $bearer))
            ->first();

        if ($token === null) {
            return response()->json([
                "message" => "Access token is not valid.",
            ], 401);
        }

        $user = User::query()
            ->where("id", $token->tokenable_id)
            ->first();

        Auth::login(user: $user);

        return $next($request);
    }
}
