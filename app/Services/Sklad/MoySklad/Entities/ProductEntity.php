<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Casts\Number\Number;
use App\Services\Sklad\Contracts\ProductInterface;

class ProductEntity implements ProductInterface
{
    public function __construct(
        public string $id,
        public string $name, //"П-12"
        public Number $quantity, // количество приобретенного товара
        public Number $price, //549000.0, общая стоимость в копейках
        public string $code, //"code": "APE6900", доставка null
        public string $pathName, //"pathName": "Ассортимент/пейджер"
    ) {

    }
}
