<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use App\Services\Sklad\MoySklad\MoySkladService;
use App\Services\Sklad\MoySklad\Parser\Parser;
use App\Services\Sklad\MoySklad\MoySkladConfig;
use App\Services\Cdek\CdekService;
use App\Services\Cdek\CdekConfig;
use App\Services\Engine\EngineService;


abstract class TestCase extends BaseTestCase
{

    protected $moySkladService;
    protected $cdekService;
    protected $engineService;

    public function setUp(): void
    {
        parent::setUp();

        $ms_config = config('services.moysklad');
        $this->moySkladService = new MoySkladService(
            new MoySkladConfig(
                login: $ms_config['login'],
                password: $ms_config['password'],
                url: $ms_config['url']),
            new Parser()
        );

        $cd_config = config('services.cdek');
        $this->cdekService = new CdekService(new CdekConfig(
            login: $cd_config['login'],
            password: $cd_config['password'],
            url: $cd_config['url']
        ));

        $this->engineService = new EngineService($this->moySkladService, $this->cdekService);
    }
}
