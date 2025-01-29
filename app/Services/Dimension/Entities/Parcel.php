<?php

namespace App\Services\Dimension\Entities;

use App\Casts\Number\Number;

/**
 * мм
 * @property Number $width
 * @property Number $height
 * @property Number $length
 * @property Number $weight
 * @property Number $number
 */
class Parcel
{
    public function __construct(
        public Number $width,
        public Number $height,
        public Number $length,
        public Number $weight,
        public Number $number
    ) {}
}
