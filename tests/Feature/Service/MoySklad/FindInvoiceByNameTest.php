<?php

namespace Tests\Feature\Service\MoySklad;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use Tests\TestCase;

use App\Services\Sklad\MoySklad\Data\InvoiceData;

class FindInvoiceByNameTest extends TestCase
{
    public function test_findInvoiceByName(): void
    {
        $invoiceData = new InvoiceData(
        name: '1дпи',
        year: '2025'
        );

        $response = GetInvoiceoutAction::make($this->moySkladService)->findInvoiceByName($invoiceData);

        dd($response);
        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
