<?php

namespace Tests\Feature\Service\MoySklad;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Data\InvoiceData;

class GetInvoiceoutActionTest extends TestCase
{

    public function test_get_invoiceout_action(): void
    {
        $invoiceData = new InvoiceData(
            name: '1дпи',
            year: '2025'
        );

        $response = GetInvoiceoutAction::make($this->moySkladService)
        ->findInvoiceByName($invoiceData)
        ->getInvoice()
        ->getAgent()
        ->getAssortiments()
        ->run();

        dd($response);
    }
}
