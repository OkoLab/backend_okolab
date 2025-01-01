<?php

namespace App\Services\MoySklad;

use App\Services\MoySklad\MoySkladConfig;
use App\Services\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\MoySklad\Entities\InvoiceoutEntity;
use App\Services\MoySklad\Data\CounterpartyString;

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
