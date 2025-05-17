<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\CreateTokenController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SendEmailVerificationCodeController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\User\CreateUserController;
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
