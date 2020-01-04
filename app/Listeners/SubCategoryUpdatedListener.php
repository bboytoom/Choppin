<?php

namespace App\Listeners;

use App\Events\SubCategoryupdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Product;

class SubCategoryUpdatedListener
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
     * @param  SubCategoryupdated  $event
     * @return void
     */
    public function handle(SubCategoryupdated $event)
    {
        if($event->subcategory->status === "0")
        {
            Product::where('subcategory_id', $event->subcategory->id)->update(['status' => 0]);
        }
        else
        {
            Product::where('subcategory_id', $event->subcategory->id)->update(['status' => 1]);
        }
    }
}
