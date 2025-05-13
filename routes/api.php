<?php

declare(strict_types=1);

use App\Http\Controllers\Search\SearchController;
use Illuminate\Support\Facades\Route;

require_once __DIR__ . "/api/artists.php";
require_once __DIR__ . "/api/auth.php";
require_once __DIR__ . "/api/collection.php";
require_once __DIR__ . "/api/me.php";

Route::get("search", SearchController::class);
