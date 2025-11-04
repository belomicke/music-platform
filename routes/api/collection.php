<?php

declare(strict_types=1);

use App\Http\Controllers\Collection\AddArtistToCollectionController;
use App\Http\Controllers\Collection\AddReleaseToCollectionController;
use App\Http\Controllers\Collection\AddTrackToCollectionController;
use App\Http\Controllers\Collection\GetCollectionController;
use App\Http\Controllers\Collection\GetFavoriteArtistsController;
use App\Http\Controllers\Collection\GetFavoriteReleasesController;
use App\Http\Controllers\Collection\GetFavoriteTracksController;
use App\Http\Controllers\Collection\RemoveArtistFromCollectionController;
use App\Http\Controllers\Collection\RemoveReleaseFromCollectionController;
use App\Http\Controllers\Collection\RemoveTrackFromCollectionController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "collection",
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get("", GetCollectionController::class);

    Route::prefix("artists")->group(function () {
        Route::get("", GetFavoriteArtistsController::class);
        Route::put("", AddArtistToCollectionController::class);
        Route::delete("", RemoveArtistFromCollectionController::class);
    });

    Route::prefix("releases")->group(function () {
        Route::get("", GetFavoriteReleasesController::class);
        Route::put("", AddReleaseToCollectionController::class);
        Route::delete("", RemoveReleaseFromCollectionController::class);
    });

    Route::prefix("tracks")->group(function () {
        Route::get("", GetFavoriteTracksController::class);
        Route::put("", AddTrackToCollectionController::class);
        Route::delete("", RemoveTrackFromCollectionController::class);
    });
});
