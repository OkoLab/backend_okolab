<?php

namespace App\Types;
use App\Types\Dimensions;

class Item extends Dimensions {
    private int $weight;

    public function __construct(int $width, int $height, int $length, int $weight) {
        parent::__construct($width, $height, $length);
        $this->weight = $weight;
    }


    public function __get($property)
    {
        return $this->$property;
    }
}
