<?php

declare(strict_types=1);

use App\Modules\Follow\Http\Controllers\AddTrackToFavoriteController;
use App\Modules\Follow\Http\Controllers\FollowArtistController;
use App\Modules\Follow\Http\Controllers\FollowReleaseController;
use App\Modules\Follow\Http\Controllers\RemoveTrackFromFavoriteController;
use App\Modules\Follow\Http\Controllers\UnfollowArtistController;
use App\Modules\Follow\Http\Controllers\UnfollowReleaseController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")
    ->prefix("collection")
    ->group(function () {
        Route::prefix("artists")->group(function () {
            Route::put("", FollowArtistController::class);
            Route::delete("", UnfollowArtistController::class);
        });

        Route::prefix("releases")->group(function () {
            Route::put("", FollowReleaseController::class);
            Route::delete("", UnfollowReleaseController::class);
        });

        Route::prefix("tracks")->group(function () {
            Route::put("", AddTrackToFavoriteController::class);
            Route::delete("", RemoveTrackFromFavoriteController::class);
        });
    });
