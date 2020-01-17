<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhotoGalleryUpdate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $image;
    public $base;
    public $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $image, $base, $type)
    {
        $this->id = $id;
        $this->image = $image;
        $this->base = $base;
        $this->type = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
