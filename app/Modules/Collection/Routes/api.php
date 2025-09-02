<?php

declare(strict_types=1);

use App\Modules\Collection\Http\Controller\GetCollectionController;
use App\Modules\Collection\Http\Controller\GetFavoriteArtistsController;
use App\Modules\Collection\Http\Controller\GetFavoriteReleasesController;
use App\Modules\Collection\Http\Controller\GetFavoriteTracksController;
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
