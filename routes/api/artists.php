<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\GetArtistController;
use App\Http\Controllers\Artist\GetPopularArtists;

Route::group(["prefix" => "artists"], function () {
    Route::get("", GetPopularArtists::class);
    Route::get("{uuid}", GetArtistController::class);
});
