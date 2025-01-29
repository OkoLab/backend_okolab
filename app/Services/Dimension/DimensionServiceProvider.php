<?php

namespace App\Services\Dimension;

use Illuminate\Support\ServiceProvider;

class DimensionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        }
    }
}
