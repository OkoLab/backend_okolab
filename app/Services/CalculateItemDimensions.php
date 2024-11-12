<?php

namespace App\Services;

use App\Types\Dimensions;
use App\Types\Product;
use Exception;

// TODO 07/11/2024 Создать функцию которая принимает объект с артикулом и количеством и рассчитывает общий объем всего оборудования
class CalculateItemDimensions {
    //private $default_box_size = new Dimensions(37, 21, 7);

    public function __construct() {

    }

    public function getTotalVolume(array $products): int {
        $result = 0;
        // foreach ($products as $product) {
        //    if ($product instanceof Product) {

        //    } else {
        //         throw new Exception("Invalid object passed. Expected instance of MyClass.");
        //    }
        // }
        return $result;
    }
}
