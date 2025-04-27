<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\Following\FollowArtistController;
use App\Http\Controllers\Artist\Following\UnfollowArtistController;
use App\Http\Controllers\Artist\GetArtistController;
use App\Http\Controllers\Artist\GetPopularArtists;

Route::group(["prefix" => "artists"], function () {
    Route::get("", GetPopularArtists::class);
    Route::get("{artist:uuid}", GetArtistController::class);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("{artist:uuid}/following", FollowArtistController::class);
        Route::delete("{artist:uuid}/following", UnfollowArtistController::class);
    });
});
