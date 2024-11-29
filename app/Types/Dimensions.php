<?php

namespace App\Types;

use Exception;

class Dimensions {
    protected int $width, $height, $length;

    public function __construct(int $width, int $height, int $length) {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    public function __get($property):int
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        throw new Exception("Invalid property: " . $property);
    }

    public function getVolume(): int {
        return $this->width * $this->length * $this->height;
    }
}
