<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\CurrentUserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class GetCurrentUserController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return $this->success([
            "user" => CurrentUserResource::make(Auth::user()),
        ]);
    }
}
