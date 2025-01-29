<?php

namespace App\Services\Cdek\Data;

class PackageData
{
    public function __construct(
        // Номер упаковки (можно использовать порядковый номер упаковки заказа или номер заказа),
        // уникален в пределах заказа. Идентификатор заказа в ИС Клиента
        public readonly string $number,
        // Общий вес (в граммах), вес округляется в большую сторону
        public readonly int $weight,
        // Габариты упаковки. Длина (в сантиметрах)
        public readonly int $length,
        // Габариты упаковки. Ширина (в сантиметрах)
        public readonly int $width,
        // Габариты упаковки. Высота (в сантиметрах)
        public readonly int $height,

        public readonly array $items
    ) {}
}
