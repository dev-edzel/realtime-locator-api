<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusRequest;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function store(BusRequest $request)
    {
        $validated = $request->validated();

        $bus = Bus::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bus created successfully',
            'bus' => $bus
        ], 201);
    }

    public function index(Request $request)
    {
        $bus = Bus::all();
        return $bus;
    }
}
