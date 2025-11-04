<?php

declare(strict_types=1);

use App\Http\Controllers\Search\CreateRecentSearchController;
use App\Http\Controllers\Search\DeleteAllRecentSearchesController;
use App\Http\Controllers\Search\GetRecentSearchesController;
use App\Http\Controllers\Search\SearchController;
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
