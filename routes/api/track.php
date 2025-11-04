<?php

declare(strict_types=1);

use App\Http\Controllers\Track\GetReleaseTracksController;
use App\Http\Controllers\Track\GetTracksController;
use App\Http\Middleware\ValidUuidMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "tracks"], function () {
    Route::post("", GetTracksController::class);
});

Route::middleware(ValidUuidMiddleware::class)->group(function () {
    Route::prefix("releases")->group(function () {
        Route::get("{uuid}/tracks", GetReleaseTracksController::class);
    });
});
