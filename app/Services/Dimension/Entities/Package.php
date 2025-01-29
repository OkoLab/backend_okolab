<?php

namespace App\Services\Dimension\Entities;

class Package
{

    public function __construct(
        // Номер упаковки (можно использовать порядковый номер упаковки
        // заказа или номер заказа), уникален в пределах заказа. Идентификатор заказа в ИС Клиента
        public string $number,
        public int $weight,
        public int $length,
        public int $width,
        public int $height,
        // array of Item
        public array $item,

    )
    {
    }
}
