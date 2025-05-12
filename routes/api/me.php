<?php

declare(strict_types=1);

use App\Http\Controllers\Me\EditAccountInfoController;
use App\Http\Controllers\Me\GetMeController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "me",
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get("", GetMeController::class);
    Route::post("", EditAccountInfoController::class);
});

