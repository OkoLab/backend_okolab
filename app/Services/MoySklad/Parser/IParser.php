<?php

namespace App\Services\MoySklad\Parser;

use App\Services\Sklad\Contracts\CounterpartyData;
use Illuminate\Support\Collection;

interface IParser
{
    /**
     * @param string $inputString
     * @return \Illuminate\Support\Collection<int, CounterpartyData>
     */
    public function parseFromString(string $inputString): Collection;
}
