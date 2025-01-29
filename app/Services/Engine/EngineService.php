<?php

namespace App\Services\Engine;

use App\Services\Cdek\CdekService;
use App\Services\Sklad\MoySklad\MoySkladService;

class EngineService
{
    public function __construct(public MoySkladService $moySkladService, public CdekService $cdekService)
    {

    }

    public function run(string $inputString)
    {
        $moySkladEntity = $this->moySkladService->getEntityCollection($inputString);
        $this->cdekService->createOrders($moySkladEntity);
    }
}
