<?php

namespace App\Services\Dimension\Actions;

use App\Services\Dimension\Models\Product;
use App\Services\Dimension\Entities\Parcel;
use App\Services\Dimension\Entities\Dimensions;
use App\Services\Sklad\Contracts\ProductsInterface;
use App\Casts\Number\Number;

class CalculateParcel
{
    private $default_box_size;
    public function __construct()
    {
        // мм
        $this->default_box_size = new Dimensions(370, 210, 70);
    }

    public static function make(): static
    {
        return new static();
    }

    public function run(ProductsInterface $productCollection): Parcel
    {
        /**
         * @var Number $volume
         * @var Number $weight
         */
        $sum_volume = new Number(0);
        $sum_weight = new Number(0);

        foreach ($productCollection->getProducts() as $product) {
            $item = Product::where('code', $product->code)->first();
            if (!$item) {
                continue; //так как может быть доставка или бросить исключение?
            }


            $volume = $item->length->mul($item->width->mul($item->height));

            $sum_volume = $sum_volume->add($volume->mul($product->quantity));
            $sum_weight = $sum_weight->add($item->weight->mul($product->quantity));
        }

        /**
         * @var Number $coefficient
         * @var Number $number_of_items
         * @var Number $item_volume
         * @var Number $item_weight
         * @var Number $side_size
         */
        $coefficient = $sum_volume->div($this->default_box_size->getVolume(), 0);
        $number_of_items = $coefficient->div(new Number(10), 1);
        $item_volume = $sum_volume->div($number_of_items, 0);
        $item_weight = $sum_weight->div($number_of_items, 0)->add(new Number(1000));
        $side_size = $item_volume->cbrt();

        return new Parcel($side_size, $side_size, $side_size, $item_weight, $number_of_items);
    }
}
