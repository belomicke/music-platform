<?php

declare(strict_types=1);

use App\Http\Controllers\Player\GetPlayerStateController;
use App\Http\Controllers\Player\GetTrackFileController;
use App\Http\Controllers\Player\SetNextTrackController;
use App\Http\Controllers\Player\SetPlayerVolumeController;
use App\Http\Controllers\Player\SetPreviousTrackController;
use App\Http\Controllers\Player\SetRepeatStateController;
use App\Http\Controllers\Player\SetTrackController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "player",
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("state", GetPlayerStateController::class);

    Route::get("", GetTrackFileController::class);
    Route::post("", SetTrackController::class);

    Route::put("repeat", SetRepeatStateController::class);
    Route::put("volume", SetPlayerVolumeController::class);

    Route::post("next", SetNextTrackController::class);
    Route::post("previous", SetPreviousTrackController::class);
});
