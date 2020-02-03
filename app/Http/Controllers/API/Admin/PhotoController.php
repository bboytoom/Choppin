<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\Photo\PhotoResource;
use App\Http\Resources\Photo\PhotoCollection;
use App\Events\PhotoImageUpdated;
use App\Models\Photo;

class PhotoController extends Controller
{

    public function index($id)
    {
        $photos = Photo::whereHas('product', function ($photosEstatus) {
            $photosEstatus->where('status', 1);
        })->where('product_id', $id)->paginate(10);

        return new PhotoCollection($photos);
    }

    public function store(PhotoRequest $request)
    {
        $photo = Photo::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }

        return response(null, 201);
    }

    public function show(Photo $photo)
    {
        PhotoResource::withoutWrapping();
        return new PhotoResource($photo);
    }

    public function update(PhotoRequest $request, Photo $photo)
    {
        $photo->update($request->except(['type', 'base']));
            
        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }
            
        return response(null, 200);
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return response(null, 204);
    }
}
