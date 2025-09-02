<?php

declare(strict_types=1);

use App\Http\Middleware\ValidUuidMiddleware;
use App\Modules\Track\Http\Controllers\GetReleaseTracksController;
use App\Modules\Track\Http\Controllers\GetTracksController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "tracks"], function () {
    Route::post("", GetTracksController::class);
});

Route::middleware(ValidUuidMiddleware::class)->group(function () {
    Route::prefix("releases")->group(function () {
        Route::get("{uuid}/tracks", GetReleaseTracksController::class);
    });
});
