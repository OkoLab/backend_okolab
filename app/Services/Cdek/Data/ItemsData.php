<?php

namespace App\Services\Cdek\Data;

class ItemsData
{
    public function __construct(
        public readonly string $name, // Наименование товара (может также содержать описание товара: размер, цвет)
        public readonly int $amount,
        public readonly string $cost
    ) {
    }
}
