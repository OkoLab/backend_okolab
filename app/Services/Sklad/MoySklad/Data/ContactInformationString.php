<?php

namespace App\Services\Sklad\MoySklad\Data;

use InvalidArgumentException;

class ContactInformationString extends Abstracts\ContactInformationData
{
    public function __construct(private string $shippingScript) {
        $contactInformation = preg_replace('/.*?#/', '', $this->shippingScript);
        $shippingScriptArray = explode('/', $contactInformation);
        $this->name = $shippingScriptArray[0];
        $this->inn = $shippingScriptArray[1];
        $this->address = $shippingScriptArray[2];
        $this->contactName = $shippingScriptArray[3];
        $this->phone = $shippingScriptArray[4];
    }

    public function __get($property)
    {
        if(property_exists($this, $property)) {
            return $this->$property;
        }
        throw new InvalidArgumentException("Invalid property: " . $property);
    }
}
