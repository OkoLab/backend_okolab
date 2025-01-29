<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevicesBoxSize;

class DeviceBoxSizeController extends Controller
{
    public function index()
    {
        $devicesBoxSizes = DevicesBoxSize::all();
        return response()->json($devicesBoxSizes, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
