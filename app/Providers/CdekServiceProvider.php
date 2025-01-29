<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Cdek\CdekService;
use App\Services\Cdek\CdekConfig;


class CdekServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CdekService::class, function () {

            $config = config('services.cdek');

            return new CdekService(
                new CdekConfig(
                    login: $config['login'],
                    password: $config['password'],
                    url: $config['url']
                ),
            );
        });
    }
    public function boot(): void
    {
        //
    }
}
