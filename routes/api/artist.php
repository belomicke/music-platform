<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\GetArtistController;
use App\Http\Controllers\Artist\GetPopularArtistsController;
use App\Http\Middleware\ValidUuidMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidUuidMiddleware::class)
    ->prefix("artists")
    ->group(function () {
        Route::get("", GetPopularArtistsController::class);

        Route::get("{uuid}", GetArtistController::class);
    });
