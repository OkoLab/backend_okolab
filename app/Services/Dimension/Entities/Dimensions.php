<?php

namespace App\Services\Dimension\Entities;

use App\Casts\Number\Number;
use Exception;

class Dimensions {
    protected Number $width, $height, $length;

    public function __construct(int | string $width, int | string $height, int | string $length) {
        $this->width = new Number($width);
        $this->height = new Number($height);
        $this->length = new Number($length);
    }

    public function __get($property):int
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new Exception("Invalid property: " . $property);
    }

    public function getVolume(): Number {
        return $this->width->mul($this->height->mul($this->length ));
    }
}
