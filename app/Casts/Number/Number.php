<?php

namespace App\Casts\Number;

use Illuminate\Contracts\Database\Eloquent\Castable;
use InvalidArgumentException;

class Number implements Castable
{
    private string $value; // '123.45'

    public function __construct(string $value)
    {
        if (!is_numeric($value)) {
            throw new InvalidArgumentException(
                'Invalid amount value: ' . $value,
            );
        }

        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function floatValue(): float
    {
        return floatval($this->value);
    }

    public function intValue(): int
    {
        return intval($this->value);
    }

    public static function castUsing(array $arguments)
    {
        return NumberCast::class;
    }

    /**
     * @param Number $amount
     * @param int|null $scale
     * @return Number
     */
    public function add(Number $amount, ?int $scale = null): Number
    {
        $result = bcadd($this->value, $amount->value(), $scale);
        $result = strval(ceil(floatval($result)));

        return new Number($result);
    }

    /**
     * @param Number $amount
     * @param int|null $scale
     * @return Number
     */
    public function sub(Number $amount, ?int $scale = null): Number
    {
        $result = bcsub($this->value, $amount->value(), $scale);
        $result = strval(ceil(floatval($result)));

        return new Number($result);
    }

    /**
     * @param Number $amount
     * @param int|null $scale
     * @return Number
     */
    public function mul(Number $amount, ?int $scale = null): Number
    {
        $result = bcmul($this->value, $amount->value(), $scale);
        $result = strval(ceil(floatval($result)));

        return new Number($result);
    }

    /**
     * @param Number $amount
     * @param int|null $scale
     * @return Number
     */
    public function div(Number $amount, ?int $scale = null): Number
    {
        $result = bcdiv($this->value, $amount->value(), $scale);
        $result = strval(ceil(floatval($result)));

        return new Number($result);
    }


    // кубический корень
    public function cbrt(): Number
    {
        $x = '1';
        $t = '0';

        // Используем метод Ньютона для нахождения кубического корня
        while (bccomp($x, $t) !== 0) {
            $t = $x;
            // x = (2 * x + number / (x * x)) / 3
            $x = bcdiv(bcadd(bcmul('2', $t), bcdiv($this->value(), bcmul($t, $t))), '3');
        }

        $x = strval(ceil(floatval($x)));

        return  new Number($x);
    }

    public function __toString()
    {
        return $this->value();
    }

}
