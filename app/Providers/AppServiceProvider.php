<?php

namespace App\Providers;

use App\Services\CdekApiService;
use App\Services\CalculateItemDimensions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CdekApiService::class, function (Application $app) {
            return new CdekApiService($app->make(CalculateItemDimensions::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
