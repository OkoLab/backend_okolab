<?php

namespace App\Http\Controllers;

use App\Models\PackingBoxSize;

class PackingBoxSizeController extends Controller
{
    public function index()
    {
        $packingBoxSizes = PackingBoxSize::all();
        return response()->json($packingBoxSizes, 200);
    }
}
