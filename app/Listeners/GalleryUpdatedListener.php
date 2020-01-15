<?php

namespace App\Listeners;

use App\Events\Galleryupdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Gallery;

class GalleryUpdatedListener
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
     * @param  Galleryupdated  $event
     * @return void
     */
    public function handle(Galleryupdated $event)
    {
        Gallery::where('category_id', $event->gallery->category_id)->where('id', '!=', $event->gallery->id)->update(['active' => 0]);
        Gallery::where('category_id', $event->gallery->category_id)->where('id', $event->gallery->id)->update(['active' => 1]);
    }
}
