<?php

namespace Tests\Feature\Service\MoySklad;

use Tests\TestCase;

use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\Parser\Parser;

class ParserTest extends TestCase
{
    public function test_getParser(): void
    {
        $invoiceData = new InvoiceData(
        name: '1дпи',
        year: '2025'
        );

        $response = (new Parser())->parseFromString('1дпи-25');

        dd($response);
        // $response = $this->get('/');

        // $response->assertStatus(200);
    }
}
