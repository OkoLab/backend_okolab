<?php

namespace App\Services\Sklad\MoySklad\Entities;

use App\Services\Sklad\Contracts\ProductsInterface;
use App\Services\Sklad\Contracts\ProductInterface;
use InvalidArgumentException;

class ProductColletion implements ProductsInterface
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

    public function addProduct(ProductInterface $product): void {
        $this->products[] = $product;
    }

    public function getProducts(): array {
        return $this->products;
    }
}
