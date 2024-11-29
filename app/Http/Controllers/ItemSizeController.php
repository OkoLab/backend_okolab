<?php

namespace App\Http\Controllers;

use App\Services\CdekApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemSizeController extends Controller
{
    /**
     * Handle the incoming request.
     */

    //public function __invoke(CalculateItemDimensions $calculateItemDimensions, Request $request)
    public function __invoke(Request $request, CdekApiService $cdekApiService)
    {
        $deviceAmount = json_decode($cdekApiService->calculatorTariff($request));
        return response()->json($deviceAmount->total_sum, 200);
    }
}
