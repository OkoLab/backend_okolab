<?php

namespace App\Support;

use App\Casts\Number\Number;

class Converter
{
    public static function mmToCm(Number $number): Number
    {
        return $number->div(new Number('10'), 0);
    }

    public static function kopeikiToRuble(Number $number): Number
    {
        return $number->div(new Number('100'));
    }
}
