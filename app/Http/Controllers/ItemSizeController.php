<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculateItemDimensions;
use App\Types\Parcel;
use Illuminate\Support\Facades\Log;

class ItemSizeController extends Controller
{
    public function __invoke(Request $request, CalculateItemDimensions $calculateItemDimensions)
    {
        /**
         * @var Parcel $parcel
         */
        $parcel = $calculateItemDimensions->getTotalDimensions($request->all());

        $parcelJson = json_encode([
            'length' => $parcel->length,
            'width' => $parcel->width,
            'height' => $parcel->height,
            'weight' => $parcel->weight,
            'number' => $parcel->number
        ]);

        //return response()->json($parcel, 200);
        return response()->json($parcelJson, 200);
    }
}
