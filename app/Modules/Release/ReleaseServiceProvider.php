<?php

declare(strict_types=1);

namespace App\Modules\Release;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class ReleaseServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        });

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
