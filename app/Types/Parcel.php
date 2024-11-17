<?php

namespace App\Types;

class Parcel extends Item {

    public int $number;
    public function __construct(int $width, int $height, int $length, int $weight, int $number) {
        parent::__construct($width, $height, $length, $weight);
        $this->number = $number;
    }
}

