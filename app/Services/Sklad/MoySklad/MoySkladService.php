<?php

namespace App\Services\Sklad\MoySklad;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\Entities\InvoiceoutEntity;
use App\Services\Sklad\MoySklad\Parser\IParser;
use Illuminate\Support\Collection;

class MoySkladService
{
    public function __construct(
        public readonly MoySkladConfig $config,
        public readonly IParser $parser
    ) {

    }

    /**
     * @param string $inputString
     * @return Collection<int, InvoiceoutEntity>
     */
    public function getEntityCollection(string $inputString): Collection
    {
        $dataCollection = $this->parser->parseFromString($inputString);

        return collect($dataCollection)->map(function (InvoiceData $invoiceData) {
                $entity = GetInvoiceoutAction::make($this)
                ->findInvoiceByName($invoiceData)
                ->getInvoice()
                ->getAgent()
                ->getAssortiments()
                ->run();

                return $entity;
        });
    }




    // public function createInvoiceoutEntity(string $cmd): InvoiceoutEntity
    // {
    //     $counterpartyData = new CounterpartyString($cmd);
    //     return GetInvoiceoutAction::make($this)
    //         ->findByName($counterpartyData)
    //         ->getAssortiments()
    //         ->run();
    // }

}
