<?php

declare(strict_types=1);

namespace App\Modules\Search\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Search\Actions\CreateRecentSearchAction;
use App\Modules\Search\Http\Requests\CreateRecentSearchRequest;
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
