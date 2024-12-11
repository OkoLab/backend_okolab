<?php

use App\Http\Controllers\DeviceBoxSizeController;
use App\Http\Controllers\ItemSizeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PackingBoxSizeController;
use App\Http\Controllers\CdekApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

// TODO : сделать ->middleware('auth:sanctum')
Route::resource('/deviceboxsizes', DeviceBoxSizeController::class);
Route::post('/calculate_tariff', ItemSizeController::class)->middleware('auth:sanctum');


/** Cdek API */
//Route::get('/location/suggest/cities?name={name}', [CdekApiService::class, 'locationSuggestCities']);
Route::get('/location/suggest/cities', [CdekApiController::class, 'suggestCities'])->middleware('auth:sanctum');



// Route::get('/item_size', function (Request $request) {
//     return response()->json('csdcdscdscdscdc', 200);
// });

