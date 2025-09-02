<?php

declare(strict_types=1);

namespace App\Modules\User;

use Illuminate\Support\ServiceProvider;

final class UserServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
    }
}
