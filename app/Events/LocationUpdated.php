<?php

namespace App\Events;

use App\Models\Location;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LocationUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Location $location;

    /**
     * Create a new event instance.
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        return new Channel('bus-location.' . $this->location->bus_id);

    }

    public function broadcastAs()
    {
        return 'location.updated';
    }

    public function broadcastWith()
    {
        return [
            'location' => $this->location->location,
            'latitude' => $this->location->latitude,
            'longitude' => $this->location->longitude
        ];
    }
}
