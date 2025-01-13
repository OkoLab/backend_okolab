<?php

namespace App\Services\Sklad\MoySklad;

use App\Services\Sklad\MoySklad\MoySkladConfig;
use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Entities\InvoiceoutEntity;
use App\Services\Sklad\MoySklad\Data\CounterpartyString;

class MoySkladService
{
    public function __construct(public readonly MoySkladConfig $config)
    {

    }

    public function createInvoiceoutEntity(string $cmd): InvoiceoutEntity
    {
        $counterpartyData = new CounterpartyString($cmd);
        return GetInvoiceoutAction::make($this)
            ->findByName($counterpartyData)
            ->getAssortiments()
            ->run();
    }

}
