<?php

namespace App\Services;

use App\Types\Dimensions;
use App\Types\Product;
use App\Types\Item;
use App\Models\DevicesBoxSize;
use Exception;

// TODO 07/11/2024 Создать функцию которая принимает объект с артикулом и количеством и рассчитывает общий объем всего оборудования
class CalculateItemDimensions {
    private $default_box_size;

    public function __construct() {
        $this->default_box_size = new Dimensions(37, 21, 7);
    }

    public function getTotalDimensions(array $selected_product_articles): int {
        $sum_volume = 0;
        $sum_weight = 0;
        foreach ($selected_product_articles as $product_article) {
            foreach ($product_article as $article => $amount) {
                $item = DevicesBoxSize::where('article', $article)->first();
                $volume = $item->length * $item->width * $item->height;
                $sum_volume += $volume * $amount;
                $sum_weight += $item->weight * $amount;
            }
        }

        $coefficient = ceil($sum_volume / $this->default_box_size->getVolume());
        $number_of_items = ceil($coefficient / 10);

        $item_weight = ceil($sum_weight / $number_of_items) + 1;


        $data_stub = [];
        $data1 = new Item(45, 45, 25, 3);
        $data2 = new Item(46, 46, 35, 5);
        $data_stub[] = $data1;
        $data_stub[] = $data2;
        $json = json_encode($data_stub);

        return $json;
    }
}
