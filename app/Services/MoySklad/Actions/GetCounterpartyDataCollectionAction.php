<?php

namespace App\Services\MoySklad\Actions;

use App\Services\MoySklad\Data\CounterpartyData;
use App\Services\MoySklad\MoySkladService;
use Illuminate\Support\Collection;

class GetCounterpartyDataCollectionAction
{
    public function __construct(private MoySkladService $moySkladService)
    {}

    /**
     * @param string $inputString
     * @return \Illuminate\Support\Collection<int, CounterpartyData>
     */
    public function run($inputString): Collection
    {
        return $this->moySkladService->parser->parseFromString($inputString);
    }

}
