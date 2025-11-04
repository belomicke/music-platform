<?php

declare(strict_types=1);

use App\Http\Controllers\Account\EditAccountInfoController;
use App\Http\Controllers\Account\GetMeController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")
    ->prefix("account")
    ->group(function () {
        Route::get("me", GetMeController::class);
        Route::post("me", EditAccountInfoController::class);
    });
