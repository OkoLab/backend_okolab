<?php

namespace App\Services\MoySklad\Data\Abstracts;

abstract class CounterpartyData
{
    protected string $name;
    protected string $year;

    function __get($property)
    {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
