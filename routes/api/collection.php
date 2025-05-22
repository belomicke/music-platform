<?php

declare(strict_types=1);

use App\Http\Controllers\Collection\GetCollectionController;
use App\Http\Controllers\Collection\GetFavoriteArtistsController;
use App\Http\Controllers\Collection\GetFavoriteReleasesController;
use App\Http\Controllers\Collection\GetFavoriteTracksController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "collection",
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get("", GetCollectionController::class);

    Route::get("artists", GetFavoriteArtistsController::class);
    Route::get("releases", GetFavoriteReleasesController::class);
    Route::get("tracks", GetFavoriteTracksController::class);
});
