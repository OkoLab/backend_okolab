<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $moySkladService;

    public function setUp():void  {

        parent::setUp();
        $this->moySkladService = $this->app->make('App\Services\MoySklad\MoySkladService');
    }
}
