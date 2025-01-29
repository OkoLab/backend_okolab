<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Services\Sklad\MoySklad\Data\InvoiceData;
use App\Services\Sklad\MoySklad\Parser\Parser;
use InvalidArgumentException;

class ParserTest extends TestCase
{
    public function test_correct_parseFromString(): void
    {
        $collectionFromString = (new Parser())->parseFromString('134дпи-25,456аон-25');
        $collectionTemplate = collect([
            new InvoiceData('134дпи', '2025'),
            new InvoiceData('456аон', '2025'),
        ]);

        $this->assertEquals($collectionFromString->sort(), $collectionTemplate->sort());
    }

    public function test_ExceptionIsThrown_parseFromString(): void //testExceptionIsThrown
    {
        $this->expectException(InvalidArgumentException::class);
        (new Parser())->parseFromString('134дпи-3455,456аон-25');
    }
}
