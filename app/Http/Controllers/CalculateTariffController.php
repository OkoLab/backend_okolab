<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CdekApiService;

class CalculateTariffController extends Controller
{
    public function __invoke(Request $request, CdekApiService $cdekApiService)
    {
        $deviceAmount = json_decode($cdekApiService->calculatorTariff($request));
        return response()->json(ceil($deviceAmount->total_sum), 200);
    }
}
