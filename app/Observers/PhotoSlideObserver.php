<?php

namespace App\Observers;

use App\Models\PhotoSlide;

class PhotoSlideObserver
{
    public function creating(PhotoSlide $photoSlide)
    {
        $photoSlide->name = e(strtolower($photoSlide->name));
        $photoSlide->description = e(strtolower($photoSlide->description));
        $photoSlide->status = 1;
    }

    public function updating(PhotoSlide $photoSlide)
    {
        $photoSlide->name = e(strtolower($photoSlide->name));
        $photoSlide->description = e(strtolower($photoSlide->description));
        $photoSlide->status = $photoSlide->status;
    }
}
