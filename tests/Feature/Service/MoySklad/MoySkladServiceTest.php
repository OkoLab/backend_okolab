<?php

namespace Tests\Feature\Service\MoySklad;

use Tests\TestCase;

use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\Actions\GetInvoiceoutAction;

class MoySkladServiceTest extends TestCase
{

    // public function test_getEntityCollection(): void
    // {
    //     $response = app(MoySkladService::class)->getEntityCollection('1дпи-25');

    //     dd($response);
    // }

    // public function test_getToken(): void
    // {
    //     $response = $this->moySkladService->getNewToken();
    //     dd($response);
    // }

    public function test_getInvoiceoutAction(): void
    {
        $invoiceData = new InvoiceData(
            name: '1дпи',
            year: '2025'
        );
        $response = GetInvoiceoutAction::make($this->moySkladService)
        ->findInvoiceByName($invoiceData)->getAgent()->getAssortiments()->run();
        dd($response);
    }
}
