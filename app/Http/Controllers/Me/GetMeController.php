<?php

declare(strict_types=1);

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CurrentUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class GetMeController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::user();

        return $this->success([
            "user" => CurrentUserResource::make($user),
        ]);
    }
}
