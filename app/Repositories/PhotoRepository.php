<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Events\PhotoImageUpdated;
use App\Models\Photo;

class PhotoRepository
{
    public function createPhoto(Request $request)
    {
        $photo = Photo::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }
        
        return 201;
    }

    public function updatePhoto(Request $request, $id)
    {
        $photo = Photo::find($id);
    
        if(is_null($photo)) {
            return 422;
        }

        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }

        Photo::where('id', $photo->id)->update($request->except(['type', 'base']));
        return 200;
    }

    public function deletePhoto($id)
    {
        $photo = Photo::find($id);

        if(is_null($photo)) {
            return 422;
        }

        $photo->delete();
        return 204;
    }
}
