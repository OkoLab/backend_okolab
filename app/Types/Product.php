<?php

use App\Models\DevicesBoxSize;

class Product
{
    private $articul;
    private $quantity;

    // Magic method to set the value of private properties
    // public function __set($name, $value)
    // {
    //     if ($name === 'articul') {
    //         $this->articul = $value;
    //     } elseif ($name === 'quantity') {
    //         if (is_numeric($value) && $value >= 0) {
    //             $this->quantity = $value;
    //         } else {
    //             throw new InvalidArgumentException("Quantity must be a non-negative number.");
    //         }
    //     } else {
    //         throw new Exception("Invalid property name: " . $name);
    //     }
    // }

    public function __get($name)
    {
        if ($name === 'articul') {
            if(DevicesBoxSize::where('article', $this->articul)->exists()) {
                return $this->articul;
            } else {
                throw new Exception("Invalid articul: " . $this->articul);
            }
        } elseif ($name === 'quantity') {
            return $this->quantity;
        } else {
            throw new Exception("Invalid property name: " . $name);
        }
    }
}