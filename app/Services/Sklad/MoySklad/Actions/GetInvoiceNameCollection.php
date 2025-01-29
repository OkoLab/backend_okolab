<?php

namespace App\Services\Sklad\MoySklad\Actions;

use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\MoySkladService;
use Illuminate\Support\Collection;

class GetInvoiceNameCollection
{
    public function __construct(private MoySkladService $moySkladService)
    {}

    /**
     * @param string $inputString
     * @return \Illuminate\Support\Collection<int, InvoiceData>
     */
    public function run($inputString): Collection
    {
        return $this->moySkladService->parser->parseFromString($inputString);
    }

}
