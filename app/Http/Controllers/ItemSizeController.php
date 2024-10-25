<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculateItemDimensions;

class ItemSizeController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(CalculateItemDimensions $calculateItemDimensions, Request $request)
    {
        return $calculateItemDimensions->test;
    }
}
