<?php

namespace App\Types;

use App\Models\DevicesBoxSize;
use Exception;


class Product
{
    private $quantity;

    public function __get($name)
    {
        if (DevicesBoxSize::where($name, $this->articul)->exists()) {
            return $this->quantity;
        } else {
            throw new Exception("Invalid articul: " . $this->articul);
        }
    }

    public function __set($name, $value)
    {
        if (DevicesBoxSize::where($name, $this->articul)->exists()) {
            if (is_numeric($value) && $value > 0 && $value <= 100) {
                $this->quantity = $value;
            } else {
                throw new Exception("Quantity must be a non-negative number and > 0 and <= 100.");
            }
        } else {
            throw new Exception("Invalid articul: " . $this->articul);
        }
    }
}