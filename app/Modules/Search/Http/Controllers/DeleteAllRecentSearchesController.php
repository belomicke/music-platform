<?php

declare(strict_types=1);

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Services\AuthService;
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
