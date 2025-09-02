<?php

declare(strict_types=1);

use App\Modules\Player\Http\Controllers\GetPlayerStateController;
use App\Modules\Player\Http\Controllers\GetTrackFileController;
use App\Modules\Player\Http\Controllers\SetTrackController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "player",
    "middleware" => ["auth:sanctum"]
], function () {
    Route::get("state", GetPlayerStateController::class);

    Route::get("", GetTrackFileController::class);
    Route::post("", SetTrackController::class);
});
