<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Http\Resources\Gallery\GalleryResource;
use App\Http\Resources\Gallery\GalleryCollection;
use App\Models\Gallery;

class GalleyController extends Controller
{

    public function index()
    {
        $gallery = Gallery::whereHas('category', function ($galleryEstatus) {
            $galleryEstatus->where('status', 1); 
        })->paginate(10);

        return new GalleryCollection($gallery);
    }

    public function store(GalleryRequest $request)
    {
        Gallery::create($request->all());
        return response(null, 201);
    }

    public function show(Gallery $gallery)
    {
        GalleryResource::withoutWrapping();
        return new GalleryResource($gallery);
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $gallery->update($request->all());
        return response(null, 200);
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return response(null, 204);
    }
}
