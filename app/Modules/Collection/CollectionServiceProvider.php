<?php

declare(strict_types=1);

namespace App\Modules\Collection;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

final class CollectionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('api')->prefix('api')->group(function () {
            $this->loadRoutesFrom(__DIR__ . '/Routes/api.php');
        });
    }
}
