<?php

namespace App\Services\Sklad\Contracts;

use App\Casts\Number\Number;

/**
 * @property string $id
 * @property string $invoice_name
 * @property AgentInterface $agent
 * @property ProductsInterface $positions
 * @property Number $sum
 * @property string $comment
 */

interface InvoiceInterface
{
}
