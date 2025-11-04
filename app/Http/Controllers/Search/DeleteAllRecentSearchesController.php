<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

final class DeleteAllRecentSearchesController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = AuthService::user();

        $user
            ->recent_searches()
            ->delete();

        return $this->success();
    }
}
