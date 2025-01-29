<?php

namespace App\Services\Cdek;

use App\Services\Cdek\Actions\CreateOrderAction;
use App\Services\Sklad\Contracts\InvoiceInterface;
use Illuminate\Support\Collection;

class CdekService
{
    public function __construct(public readonly CdekConfig $config)
    {

    }

    /**
     * @param Collection<int, InvoiceInterface> invoices
     */
    public function createOrders(Collection $invoices)
    {
        foreach($invoices as $invoice) {
            CreateOrderAction::make($this)->run($invoice);
        }
    }
}
