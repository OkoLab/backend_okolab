<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CalculateItemDimensions;
use Illuminate\Support\Facades\Log;

class ItemSizeController extends Controller
{
    /**
     * Handle the incoming request.
     */

    //public function __invoke(CalculateItemDimensions $calculateItemDimensions, Request $request)
    public function __invoke(Request $request, CalculateItemDimensions $calculateItemDimensions)
    {
        $data = json_decode($request[0]);
        $volume = $calculateItemDimensions->getTotalDimensions($data);
        Log::info($volume);
        return response()->json($request[0], 200);
    }

    // //public function index(CalculateItemDimensions $calculateItemDimensions, Request $request)
    // public function index()
    // {
    //     return response()->json("sdsdsadsdsadsa", 200);
    // }

    //    /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
