<?php

namespace App\Services\Dimension\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Number\Number;

/**
 * @property string $name
 * @property string $article
 * @property string $code
 * @property Number $width
 * @property Number $height
 * @property Number $length
 * @property Number $weight
 * @property Number $amount
 *
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'article',
        'code',
        'width',
        'height',
        'length',
        'weight',
        'amount',
    ];

    protected $casts = [
        'amount' => Number::class,
        'width' => Number::class,
        'height' => Number::class,
        'length' => Number::class,
        'weight' => Number::class,
    ];
}
