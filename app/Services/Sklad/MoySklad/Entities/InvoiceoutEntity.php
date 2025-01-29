<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Services\Sklad\Contracts\AgentInterface;
use App\Services\Sklad\Contracts\InvoiceInterface;
use App\Services\Sklad\Contracts\ProductsInterface;
use App\Casts\Number\Number;

/**
 * @property string $id
 * @property string $invoice_name
 * @property AgentInterface $agent
 * @property ProductsInterface $positions
 * @property Number $sum
 * @property string $comment
 */
class InvoiceoutEntity implements InvoiceInterface
{
    public string $id;
    public string $invoice_name;
    public AgentInterface $agent;
    public ProductsInterface $positions;
    public Number $sum; // копейки
    public string $comment;
}
