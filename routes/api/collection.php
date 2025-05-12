<?php

declare(strict_types=1);

use App\Http\Controllers\Collection\GetFavoriteArtistsController;
use Illuminate\Support\Facades\Route;

Route::group([
    "prefix" => "collection",
    "middleware" => [
        "auth:sanctum"
    ]
], function () {
    Route::get("artists", GetFavoriteArtistsController::class);
});
