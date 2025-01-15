<?php

namespace App\Services\MoySklad;

use App\Services\MoySklad\Parser\Parser;
use Illuminate\Support\ServiceProvider;

class MoySkladServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MoySkladService::class, function () {
            $config = config('services.moysklad');

            return new MoySkladService(
                new MoySkladConfig(login: $config['login'], password: $config['password']),
                new Parser()
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
