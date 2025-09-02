<?php

declare(strict_types=1);

use App\Modules\Search\Http\Controllers\CreateRecentSearchController;
use App\Modules\Search\Http\Controllers\DeleteAllRecentSearchesController;
use App\Modules\Search\Http\Controllers\GetRecentSearchesController;
use App\Modules\Search\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get("search", SearchController::class);

Route::group([
    "prefix" => "recent-searches",
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("", GetRecentSearchesController::class);
    Route::post("", CreateRecentSearchController::class);
    Route::delete("", DeleteAllRecentSearchesController::class);
});
