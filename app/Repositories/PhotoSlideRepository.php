<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Events\PhotoSlideUpdate;
use App\Models\PhotoSlide;

class PhotoSlideRepository
{
    public function createPhotoSlide(Request $request)
    {
        $photoslide = PhotoSlide::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($photoslide->id, $photoslide->image, $request->base, $request->type));
        }
        
        return 201;
    }

    public function updatePhotoSlide(Request $request, $id)
    {
        $slide = PhotoSlide::find($id);
    
        if(is_null($slide)) {
            return 422;
        }

        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($slide->id, $slide->image, $request->base, $request->type));
        }

        PhotoSlide::where('id', $slide->id)->update($request->except(['type', 'base']));
        return 200;
    }

    public function deletePhotoSlide($id)
    {
        $slide = PhotoSlide::find($id);

        if(is_null($slide)) {
            return 422;
        }

        $slide->delete();
        return 204;
    }
}
