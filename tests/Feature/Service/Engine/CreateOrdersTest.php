<?php

namespace Tests\Feature\Feature\Service\Cdek;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;
use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Cdek\Actions\CreateOrderAction;
use App\Services\Dimension\Models\Product;

class CreateOrdersTest extends TestCase
{
    public function test_create_orders_action(): void
    {
        $invoiceData = new InvoiceData(
            name: '1дпи',
            year: '2025'
        );

        $this->engineService->run("1дпи-25");
    }
}
