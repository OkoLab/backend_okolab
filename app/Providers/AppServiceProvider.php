<?php

namespace App\Providers;

use App\Services\CdekApiService;
use App\Services\CalculateItemDimensions;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        bcscale(8);
        $this->app->singleton(CdekApiService::class, function (Application $app) {
            return new CdekApiService($app->make(CalculateItemDimensions::class));
        });
    }

    public function boot(): void
    {
    }
}
