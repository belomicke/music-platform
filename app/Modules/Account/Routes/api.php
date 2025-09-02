<?php

declare(strict_types=1);

use App\Modules\Account\Http\Controllers\EditAccountInfoController;
use App\Modules\Account\Http\Controllers\GetMeController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")
    ->prefix("account")
    ->group(function () {
        Route::get("", GetMeController::class);
        Route::post("", EditAccountInfoController::class);
    });
