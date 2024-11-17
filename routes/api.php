<?php

use App\Http\Controllers\DeviceBoxSizeController;
use App\Http\Controllers\ItemSizeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackingBoxSizeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Services\CdekApiService;

Route::get('/user', function (Request $request) {
    return response()->json([
        'message' => $request->user(),
        200
    ]);
    //return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/link', function (Request $request) { return response()->json(['message' => 'Link', 200]); })->middleware('auth:sanctum');

Route::resource('/deviceboxsizes', DeviceBoxSizeController::class);
Route::post('/item_size', ItemSizeController::class)->middleware('auth:sanctum');


/** Cdek API */
Route::get('/cities/{name}', [CdekApiService::class, 'locationSuggestCities']);



// Route::get('/item_size', function (Request $request) {
//     return response()->json('csdcdscdscdscdc', 200);
// });

