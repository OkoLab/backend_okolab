<?php

namespace App\Services\Cdek\Data;

class PackagesData
{
    public function __construct(
        public readonly int $weight,
        public readonly int $length,
        public readonly int $width,
        public readonly int $height,
        public readonly ItemsData $items
    ) {}
}
