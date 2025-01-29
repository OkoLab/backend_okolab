<?php

use App\Services\CdekApiService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemSizeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/php', function () {
    return view('phpinfo');
});

// Route::get('/cities/{name}', [CdekApiService::class, 'locationSuggestCities']);
