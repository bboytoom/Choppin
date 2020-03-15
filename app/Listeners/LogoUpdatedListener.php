<?php

namespace App\Listeners;

use App\Events\LogoUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Configuration;

class LogoUpdatedListener
{
    public function __construct()
    {
        //
    }

    public function handle(LogoUpdated $event)
    {
        if (!is_null($event->base)) {
            $name = date('YmdHis_').$event->image;

            $this->uploadImage($event, $name);
        }
    }

    private function uploadImage(LogoUpdated $event, $name)
    {
        $base_64toImage = str_replace('data:'. $event->type .';base64,', '', $event->base);
        $image = base64_decode($base_64toImage);

        Configuration::where('id', $event->id)->update([
            'logo' => $name
        ]);

        Storage::disk('configurations')->put($name, $image);

        $imageResize = Image::make(public_path('storage/images/'.$name))->resize(300, 120);
        $imageResize->save(public_path('storage/images/'.$name));
    }
}
