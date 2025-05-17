<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\RecentSearch;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

final class DeleteAllRecentSearchesController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $user = AuthService::user();

        RecentSearch::query()
            ->where("user_id", $user->id)
            ->delete();

        return $this->success();
    }
}
