<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\FollowArtistController;
use App\Http\Controllers\Artist\GetArtistController;
use App\Http\Controllers\Artist\GetArtistReleasesController;
use App\Http\Controllers\Artist\GetPopularArtistsController;
use App\Http\Controllers\Artist\UnfollowArtistController;

Route::group([
    "prefix" => "artists"
], function () {
    Route::get("", GetPopularArtistsController::class);
    Route::get("{artist:uuid}", GetArtistController::class);

    Route::get("{artist:uuid}/releases", GetArtistReleasesController::class);

    Route::put("{artist:uuid}/follow", FollowArtistController::class);
    Route::delete("{artist:uuid}/unfollow", UnfollowArtistController::class);
});
