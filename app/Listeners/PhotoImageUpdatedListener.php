<?php

namespace App\Listeners;

use App\Events\PhotoImageUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Photo;

class PhotoImageUpdatedListener
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
     * @param  PhotoImageUpdated  $event
     * @return void
     */
    public function handle(PhotoImageUpdated $event)
    {
        $name = date('YmdHis_').$event->image;
        $base_64toImage = str_replace('data:'. $event->type .';base64,', '', $event->base);
        $image = base64_decode($base_64toImage);

         Photo::where('id', $event->id)->update([
            'image' => $name
        ]);

        Storage::disk('photo_big')->put($name, $image);
        Storage::disk('photo_small')->put($name, $image);
                
        $imageResizeBig = Image::make(public_path('product_images/big/'.$name))->resize(450, 430);
        $imageResizeBig->save(public_path('product_images/big/'.$name));

        $imageResizeSmall = Image::make(public_path('product_images/small/'.$name))->resize(310, 290);
        $imageResizeSmall->save(public_path('product_images/small/'.$name));
    }
}
