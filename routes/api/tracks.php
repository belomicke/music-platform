<?php

declare(strict_types=1);

use App\Http\Controllers\Track\AddTrackToFavoriteController;
use App\Http\Controllers\Track\GetTracksController;
use App\Http\Controllers\Track\RemoveTrackFromFavoriteController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "tracks"], function () {
    Route::post("", GetTracksController::class);

    Route::put("{track:uuid}/favorite", AddTrackToFavoriteController::class);
    Route::delete("{track:uuid}/favorite", RemoveTrackFromFavoriteController::class);
});
