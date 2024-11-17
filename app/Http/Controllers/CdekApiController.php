<?php

namespace App\Http\Controllers;

use App\Services\CdekApiService;
use Illuminate\Http\Request;

class CdekApiController extends Controller
{
    public function suggestCities(CdekApiService $cdekApiService, Request $request) {
        $response = $cdekApiService->locationSuggestCities($request->input('name'));
        return $response;
    }
}
