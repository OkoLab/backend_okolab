<?php

namespace App\Services\Sklad\Contracts;

use App\Casts\Amount\AmountValue;

/**
 * @property string $name
 * @property int $quantity
 * @property AmountValue $price // копейки
 * @property string $code
 * @property string $pathName
 */
interface ProductInterface
{

}
