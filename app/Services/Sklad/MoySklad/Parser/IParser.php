<?php

namespace App\Services\Sklad\MoySklad\Parser;

use App\Services\Sklad\MoySklad\Data\InvoiceData;
use Illuminate\Support\Collection;

interface IParser
{
    /**
     * @param string $inputString
     * @return Collection<int, InvoiceData>
     */
    public function parseFromString(string $inputString): Collection;
}
