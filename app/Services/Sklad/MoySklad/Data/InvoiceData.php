<?php

namespace App\Services\Sklad\MoySklad\Data;

/**
 * @property string $name
 * @property string $year
 */
class InvoiceData
{
    public function __construct(public string $name, public string $year) {
    }
}
