<?php

namespace App\Listeners;

use App\Events\Productupdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Characteristic;

class ProductUpdatedListener
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
     * @param  Productupdated  $event
     * @return void
     */
    public function handle(Productupdated $event)
    {
        if($event->product->status == 0)
        {
            Characteristic::where('product_id', $event->product->id)->update(['status' => 0]);
        }
        else
        {
            Characteristic::where('product_id', $event->product->id)->update(['status' => 1]);
        }
    }
}
