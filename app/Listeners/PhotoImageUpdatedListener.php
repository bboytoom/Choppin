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
    public function __construct()
    {
        //
    }

    public function handle(PhotoImageUpdated $event)
    {
        if (!is_null($event->base)) {
            $name = date('YmdHis_').$event->image;

            $this->uploadImage($event, $name);
        }
    }

    private function uploadImage(PhotoImageUpdated $event, $name)
    {
        $base_64toImage = str_replace('data:'. $event->type .';base64,', '', $event->base);
        $image = base64_decode($base_64toImage);

         Photo::where('id', $event->id)->update([
            'image' => $name
        ]);

        Storage::disk('photo_big')->put($name, $image);
        Storage::disk('photo_small')->put($name, $image);
                
        $imageResizeBig = Image::make(public_path('storage/images/big/'.$name))->resize(450, 430);
        $imageResizeBig->save(public_path('storage/images/big/'.$name));

        $imageResizeSmall = Image::make(public_path('storage/images/small/'.$name))->resize(310, 290);
        $imageResizeSmall->save(public_path('storage/images/small/'.$name));
    }
}
