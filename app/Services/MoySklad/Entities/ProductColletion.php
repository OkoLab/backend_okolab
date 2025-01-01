<?php

namespace App\Services\MoySklad\Entities;

use InvalidArgumentException;

class ProductColletion
{
    /** @var ProductEntity[] */
    private array $products;

    public function __construct(array $products = []) {
        foreach ($products as $product) {
            if (!($product instanceof ProductEntity)) {
                throw new InvalidArgumentException('All elements must be instances of ProductEntity.');
            }
        }
        $this->products = $products;
    }

    public function addProduct(ProductEntity $product): void {
        $this->products[] = $product;
    }

    public function getProducts(): array {
        return $this->products;
    }
}
