<?php

namespace Tests\Feature\Feature\Service\Cdek;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Cdek\Actions\CreateOrderAction;


class CreateOrderActionTest extends TestCase
{

    public function test_create_order_action(): void
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

        $response = CreateOrderAction::make($this->cdekService)->run($response);
        dd($response);
    }
}
