<?php

namespace App\Services\Cdek\Data;

class LocationData
{
    public function __construct(public readonly string $city, public readonly string $address) {}
}
