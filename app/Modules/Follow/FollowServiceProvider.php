<?php

declare(strict_types=1);

namespace App\Modules\Follow;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class FollowServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
