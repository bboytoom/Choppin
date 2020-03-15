<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PhotoImageUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $image;
    public $base;
    public $type;

    public function __construct($id, $image, $base, $type)
    {
        $this->id = $id;
        $this->image = $image;
        $this->base = $base;
        $this->type = $type;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
