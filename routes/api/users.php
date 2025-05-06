<?php

declare(strict_types=1);

use App\Http\Controllers\User\GetUserByIdController;
use App\Http\Controllers\User\GetUserFollowersController;
use App\Http\Controllers\User\GetUserFollowingController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "users"], function () {
    Route::get("{user:uuid}", GetUserByIdController::class);

    Route::get("{user:uuid}/following", GetUserFollowingController::class);
    Route::get("{user:uuid}/followers", GetUserFollowersController::class);
});
