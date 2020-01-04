<?php

namespace App\Listeners;

use App\Events\Categoryupdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SubCategory;

class CategoryUpdatedListener
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
     * @param  Categoryupdated  $event
     * @return void
     */
    public function handle(Categoryupdated $event)
    {
        if($event->category->status === "0")
        {
            SubCategory::where('category_id', $event->category->id)->update(['status' => 0]);
        }
        else
        {
            SubCategory::where('category_id', $event->category->id)->update(['status' => 1]);
        }
    }
}
