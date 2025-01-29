<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Engine\EngineService;
use Illuminate\Support\Facades\Log;

class CreateCdekOrder extends Controller
{
    public function __invoke(Request $request, EngineService $engineService)
    {
        try {
            $engineService->run($request->all()[0]);
            return response()->json([
                'status' => 'success',
                'message' => 'Заказы созданы'
            ], 200);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Ошибка при создании заказов'
            ], 200);
        }
    }
}
