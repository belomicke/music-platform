<?php

declare(strict_types=1);

use App\Http\Middleware\ValidUuidMiddleware;
use App\Modules\Artist\Http\Controllers\GetArtistController;
use App\Modules\Artist\Http\Controllers\GetPopularArtistsController;
use Illuminate\Support\Facades\Route;

Route::middleware(ValidUuidMiddleware::class)
    ->prefix("artists")
    ->group(function () {
        Route::get("", GetPopularArtistsController::class);

        Route::get("{uuid}", GetArtistController::class);
    });
