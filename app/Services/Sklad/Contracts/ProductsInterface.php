<?php

namespace App\Services\Sklad\Contracts;

use App\Services\Sklad\Contracts\ProductInterface;

interface ProductsInterface
{
    public function addProduct(ProductInterface $product): void;

    public function getProducts(): array;

}
