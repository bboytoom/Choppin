<?php

namespace App\Listeners;

use App\Events\PhotoGalleryUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\PhotoGallery;

class PhotoGalleryUpdateListener
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
     * @param  PhotoGalleryUpdate  $event
     * @return void
     */
    public function handle(PhotoGalleryUpdate $event)
    {
        if (!is_null($event->base)) {
            $name = date('YmdHis_').$event->image;

            $this->uploadImage($event, $name);
        }
    }

    private function uploadImage(PhotoGalleryUpdate $event, $name)
    {
        $base_64toImage = str_replace('data:'. $event->type .';base64,', '', $event->base);
        $image = base64_decode($base_64toImage);

         PhotoGallery::where('id', $event->id)->update([
            'image' => $name
        ]);

        Storage::disk('slide')->put($name, $image);

        $imageResize = Image::make(public_path('storage/images/slide/'.$name))->resize(1920, 700);
        $imageResize->save(public_path('storage/images/slide/'.$name));
    }
}
