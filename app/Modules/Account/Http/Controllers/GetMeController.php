<?php

declare(strict_types=1);

namespace App\Modules\Account\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Resources\CurrentUserResource;
use App\Modules\Auth\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class GetMeController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = AuthService::user();

        return $this->success([
            "user" => CurrentUserResource::make($user),
        ]);
    }
}
