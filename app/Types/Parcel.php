<?php

namespace App\Types;

use Exception;

class Parcel extends Item {

    protected int $number;
    public function __construct(int $width, int $height, int $length, int $weight, int $number) {
        parent::__construct($width, $height, $length, $weight);
        $this->number = $number;
    }

    public function __get($property):int
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else if (property_exists(get_parent_class($this), $property)) {
            return parent::__get($property);
        }
        throw new Exception("Invalid property: " . $property);
    }
}

