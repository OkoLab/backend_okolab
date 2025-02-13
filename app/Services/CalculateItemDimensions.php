<?php

namespace App\Services;

use App\Types\Dimensions;
use App\Types\Parcel;
use App\Models\DevicesBoxSize;
use Exception;

class CalculateItemDimensions
{
    private $default_box_size;

    public function __construct()
    {
        $this->default_box_size = new Dimensions(370, 210, 70);
    }

    // $selected_product_articles - {"article": "колисечество оборудования", },"2300":8}
    public function getTotalDimensions($selected_product_articles): Parcel
    {
        $sum_volume = 0;
        $sum_weight = 0;
        foreach ($selected_product_articles as $article => $amount) {
            $item = DevicesBoxSize::where('article', $article)->first();
            if (!$item) {
                throw new Exception("Invalid articul: " . $article);
            }
            $volume = $item->length * $item->width * $item->height;
            $sum_volume += $volume * $amount;
            $sum_weight += $item->weight * $amount;
        }


        $coefficient = ceil($sum_volume / $this->default_box_size->getVolume());
        $number_of_items = ceil($coefficient / 10);
        $item_volume = ceil($sum_volume / $number_of_items);
        $item_weight = ceil($sum_weight / $number_of_items) + 1000;

        $side_size = ceil(pow($item_volume, 1 / 3));

        $result = new Parcel($side_size, $side_size, $side_size, $item_weight, $number_of_items);

        return $result;
    }
}
