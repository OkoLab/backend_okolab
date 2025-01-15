<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use App\Services\Sklad\MoySklad\Parser\CounterpartyDataFactory;
use App\Services\Sklad\MoySklad\Data\MoySkladCounterpartyData;
use InvalidArgumentException;

class CounterpartyDataFactoryTest extends TestCase
{
    public function test_correct_parseFromString(): void
    {
        $collectionFromString = CounterpartyDataFactory::parseFromString('134дпи-25,456аон-25');
        $collectionTemplate = collect([
            new MoySkladCounterpartyData('134дпи', '25'),
            new MoySkladCounterpartyData('456аон', '25'),
        ]);

        $this->assertEquals($collectionFromString->sort(), $collectionTemplate->sort());
    }

    public function test_ExceptionIsThrown_parseFromString(): void //testExceptionIsThrown
    {
        $this->expectException(InvalidArgumentException::class);
        CounterpartyDataFactory::parseFromString('134дпи-25456аон-25');
    }
}
