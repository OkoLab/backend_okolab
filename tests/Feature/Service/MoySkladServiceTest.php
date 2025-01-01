<?php

namespace Tests\Feature\Service;

use Tests\TestCase;
use App\Services\MoySklad\MoySkladService;

class MoySkladServiceTest extends TestCase
{
    public function test_moysklad_service(): void
    {
        $response = $this->moySkladService->createInvoiceoutEntity('1дпи-25');

        dd($response);
    }
}
