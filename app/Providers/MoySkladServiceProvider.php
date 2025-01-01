<?php

namespace App\Providers;

use App\Services\MoySklad\MoySkladConfig;
use App\Services\MoySklad\MoySkladService;
use Illuminate\Support\ServiceProvider;

class MoySkladServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(MoySkladService::class, function () {
            $config = config('services.moysklad');

            return new MoySkladService(
                new MoySkladConfig(
                    login: $config['login'],
                    password: $config['password'],
                ),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
