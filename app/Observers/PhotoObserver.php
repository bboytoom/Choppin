<?php

namespace App\Observers;

use App\Models\Photo;

class PhotoObserver
{
    public function creating(Photo $photo)
    {
        $photo->name = e(strtolower($photo->name));
        $photo->description = e(strtolower($photo->description));
        $photo->status = 1;
    }

    public function updating(Photo $photo)
    {
        $photo->name = e(strtolower($photo->name));
        $photo->description = e(strtolower($photo->description));
        $photo->status = $photo->status;
    }
}
