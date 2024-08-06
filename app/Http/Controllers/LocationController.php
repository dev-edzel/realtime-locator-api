<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Jobs\UpdateBusLocation;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(LocationRequest $request)
    {
        $validated = $request->validated();

        dispatch(new UpdateBusLocation(
            $validated['bus_id'],
            $validated['location'],
            $validated['latitude'],
            $validated['longitude']
        ));

        return response()->json([
            'message' => 'Bus location update queued successfully'
        ], 202);
    }

    public function show($busId)
    {
        $location = Location::where('bus_id', $busId)
            ->latest()
            ->first();

        if (!$location) {
            return response()->json([
                'message' => 'No location found for this bus'
            ], 404);
        }

        return response()->json($location);
    }
}
