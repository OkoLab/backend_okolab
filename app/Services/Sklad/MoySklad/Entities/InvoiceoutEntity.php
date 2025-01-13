<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Services\Sklad\MoySklad\Data\Abstracts\ContactInformationData;
use InvalidArgumentException;

class InvoiceoutEntity
{
    private string $id;
    private string $name;
    private ContactInformationData $contactInformation;
    private ProductColletion $positions;

    public function __get($name)
    {
        if(property_exists($this, $name)){
            return $this->$name;
        }

        throw new InvalidArgumentException("Invalid property: " . $name);
    }

    public function __set($name, $value)
    {
        if(property_exists($this, $name)){
            return $this->$name = $value;
        }

        throw new InvalidArgumentException("Invalid property: " . $name);
    }
}
