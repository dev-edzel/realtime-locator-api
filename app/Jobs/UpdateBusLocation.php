<?php

namespace App\Jobs;

use App\Events\LocationUpdated;
use App\Models\Location;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateBusLocation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $busId;
    public $location;
    public $latitude;
    public $longitude;


    /**
     * Create a new job instance.
     */
    public function __construct($busId, $location, $latitude, $longitude)
    {
        $this->busId = $busId;
        $this->location = $location;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $locationRecord = Location::create([
            'bus_id' => $this->busId,
            'location' => $this->location,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        event(new LocationUpdated($locationRecord));
    }
}
