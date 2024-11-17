<?php

namespace App\Types;

class Dimensions {
    public int $width, $height, $length;

    public function __construct(int $width, int $height, int $length) {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    public function getVolume(): int {
        return $this->width * $this->length * $this->height;
    }
}
