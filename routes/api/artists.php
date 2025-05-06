<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\GetArtistController;
use App\Http\Controllers\Artist\GetPopularArtistsController;

Route::group(["prefix" => "artists"], function () {
    Route::get("", GetPopularArtistsController::class);
    Route::get("{artist:uuid}", GetArtistController::class);
});
