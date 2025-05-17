<?php

declare(strict_types=1);

namespace App\Http\Controllers\Search;

use App\Actions\Search\RecentSearch\CreateRecentSearchAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\CreateRecentSearchRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

final class CreateRecentSearchController extends Controller
{
    /**
     * @throws Throwable
     */
    public function __invoke(
        CreateRecentSearchRequest $request,
        CreateRecentSearchAction  $createRecentSearchAction
    ): JsonResponse
    {
        $uuid = $request->input("id");
        $type = $request->input("type");

        $createRecentSearchAction->execute(
            uuid: $uuid,
            type: $type
        );

        return $this->success();
    }
}
