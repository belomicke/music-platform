<?php

declare(strict_types=1);

use App\Http\Controllers\Me\Following\AttachFollowingController;
use App\Http\Controllers\Me\Following\DetachFollowingController;
use App\Http\Controllers\Me\GetMeController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "me",
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get("", GetMeController::class);

    Route::put("following", AttachFollowingController::class);
    Route::delete("following", DetachFollowingController::class);
});

