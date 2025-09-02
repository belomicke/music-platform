<?php

declare(strict_types=1);

use App\Modules\Auth\Http\Controllers\CreateTokenController;
use App\Modules\Auth\Http\Controllers\CreateUserController;
use App\Modules\Auth\Http\Controllers\ForgotPasswordController;
use App\Modules\Auth\Http\Controllers\LogOutController;
use App\Modules\Auth\Http\Controllers\ResetPasswordController;
use App\Modules\Auth\Http\Controllers\SendEmailVerificationCodeController;
use App\Modules\Auth\Http\Controllers\SignInController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "auth"], function () {
    Route::middleware("auth:sanctum")->group(function () {
        Route::delete("log-out", LogOutController::class);
    });

    Route::middleware("guest")->group(function () {
        Route::post("token", CreateTokenController::class);

        Route::post("sign-in", SignInController::class);
        Route::post("sign-up", CreateUserController::class);

        Route::post("email-verification-code", SendEmailVerificationCodeController::class);

        Route::post("forgot-password", ForgotPasswordController::class);
        Route::post("reset-password", ResetPasswordController::class);
    });
});
