<?php

declare(strict_types=1);

use App\Http\Controllers\Artist\GetUserFollowedArtists;
use App\Http\Controllers\User\GetUserByIdController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "users"], function () {
    Route::get("{user:uuid}", GetUserByIdController::class);

    Route::get("{user:uuid}/artists", GetUserFollowedArtists::class);
});
