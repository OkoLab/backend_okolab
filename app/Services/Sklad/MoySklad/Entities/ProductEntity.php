<?php

namespace App\Services\Sklad\MoySklad\Entities;

class ProductEntity
{
    public function __construct(
        public string $id,
        public string $name, //"П-12"
        public int $quantity, // количество приобретенного товара
        public string $price, //549000.0, общая стоимость в копейках
        public string $code, //"code": "APE6900", доставка null
        public string $pathName, //"pathName": "Ассортимент/пейджер"
    ) {

    }
}
