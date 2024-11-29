<?php

namespace App\Types;
use App\Types\Dimensions;
use Exception;

class Item extends Dimensions {
    protected int $weight;

    public function __construct(int $width, int $height, int $length, int $weight) {
        parent::__construct($width, $height, $length);
        $this->weight = $weight;
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
