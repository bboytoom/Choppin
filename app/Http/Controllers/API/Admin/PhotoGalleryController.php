<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoGalleryRequest;
use App\Http\Resources\PhotoGallery\PhotoGalleryResource;
use App\Http\Resources\PhotoGallery\PhotoGalleryCollection;
use App\Events\PhotoGalleryUpdate;
use App\Models\PhotoGallery;

class PhotoGalleryController extends Controller
{

    public function index($id)
    {
        $photosGallery = PhotoGallery::whereHas('gallery', function ($photosGalleryEstatus) {
            $photosGalleryEstatus->where('status', 1);
        })->where('gallery_id', $id)->paginate(10);

        return new PhotoGalleryCollection($photosGallery);
    }

    public function store(PhotoGalleryRequest $request)
    {
        $photosgallery = PhotoGallery::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
        }

        return response(null, 201);
    }

    public function show(PhotoGallery $photosgallery)
    {
        PhotoGalleryResource::withoutWrapping();
        return new PhotoGalleryResource($photosgallery);
    }

    public function update(PhotoGalleryRequest $request, PhotoGallery $photosgallery)
    {
        $photosgallery->update($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
        }

        return response(null, 200);
    }

    public function destroy(PhotoGallery $photosgallery)
    {
        $photosgallery->delete();
        return response(null, 204);
    }
}
