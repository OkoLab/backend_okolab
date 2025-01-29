<?php

namespace Tests\Feature\Service\MoySklad;

use Tests\TestCase;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Data\InvoiceData;


class GetAgentTest extends TestCase
{
    public function test_get_agent(): void
    {
        $invoiceData = new InvoiceData(
            name: '1дпи',
            year: '2025'
        );

        $response = GetInvoiceoutAction::make($this->moySkladService)
        ->findInvoiceByName($invoiceData)
        ->getInvoice()
        ->getAgent();

        dd($response);
    }
}
