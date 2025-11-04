<?php

declare(strict_types=1);

use App\Http\Controllers\Release\GetArtistReleasesController;
use App\Http\Controllers\Release\GetReleaseController;
use App\Http\Middleware\ValidUuidMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidUuidMiddleware::class)->group(function () {
    Route::prefix("releases")->group(function () {
        Route::get("{uuid}", GetReleaseController::class);
    });

    Route::prefix("artists")->group(function () {
        Route::get("{uuid}/releases", GetArtistReleasesController::class);
    });
});
