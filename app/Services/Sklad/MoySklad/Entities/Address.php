<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Services\Sklad\Contracts\AddressInterface;

class Address implements AddressInterface
{
    public function __construct(public string $city, public string $street, public string $house, public string $apartment)
    {
    }

}
