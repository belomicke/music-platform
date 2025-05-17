<?php

declare(strict_types=1);

use App\Http\Controllers\Release\FollowReleaseController;
use App\Http\Controllers\Release\GetReleaseController;
use App\Http\Controllers\Release\UnfollowReleaseController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "releases"], function () {
    Route::get("{release:uuid}", GetReleaseController::class);

    Route::put("{release:uuid}/follow", FollowReleaseController::class);
    Route::delete("{release:uuid}/unfollow", UnfollowReleaseController::class);
});
