<?php

namespace App\Listeners;

use App\Events\Userupdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Shipping;

class UserUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Userupdated  $event
     * @return void
     */
    public function handle(Userupdated $event)
    {
        if($event->user->status == 0)
        {
            Shipping::where('user_id', $event->user->id)->update(['status' => 0]);
        }
        else
        {
            Shipping::where('user_id', $event->user->id)->update(['status' => 1]);
        }
    }
}
