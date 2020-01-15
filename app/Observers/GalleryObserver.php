<?php

namespace App\Observers;

use App\Models\Gallery;

class GalleryObserver
{
    /**
     * Handle the gallery "created" event.
     *
     * @param  \App\Gallery  $gallery
     * @return void
     */
    public function created(Gallery $gallery)
    {
        Gallery::where('category_id', $gallery->category_id)->where('id', '!=', $gallery->id)->update(['active' => 0]);
        Gallery::where('category_id', $gallery->category_id)->where('id', $gallery->id)->update(['active' => 1]);
    }

    /**
     * Handle the gallery "updated" event.
     *
     * @param  \App\Gallery  $gallery
     * @return void
     */
    public function updated(Gallery $gallery)
    {
        Gallery::where('category_id', $gallery->category_id)->where('id', '!=', $gallery->id)->update(['active' => 0]);
        Gallery::where('category_id', $gallery->category_id)->where('id', $gallery->id)->update(['active' => 1]);
    }

    /**
     * Handle the gallery "saving" event.
     *
     * @param  \App\Gallery  $gallery
     * @return void
     */
    public function saving(Gallery $gallery)
    {
        $gallery->name = e(strtolower($gallery->name));
    }
}
