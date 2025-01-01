<?php

namespace App\Services\MoySklad\Data;

use App\Services\MoySklad\Data\Abstracts\CounterpartyData;

class CounterpartyString extends CounterpartyData
{
    function __construct(public string $cmd) {
        $splitNameAndYear = explode('-', $cmd);
        $this->name = $splitNameAndYear[0];
        $this->year = 20 . ($splitNameAndYear[1]);
    }
}
