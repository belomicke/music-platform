<?php

declare(strict_types=1);

use App\Http\Controllers\Player\GetTrackFileController;
use App\Http\Controllers\Player\InitPlayerController;
use App\Http\Controllers\Player\SetTrackController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "player",
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("init", InitPlayerController::class);

    Route::get("", GetTrackFileController::class);
    Route::post("", SetTrackController::class);
});
