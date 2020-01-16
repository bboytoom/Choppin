<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoGalleryRequest;
use App\Http\Resources\PhotoGallery\PhotoGalleryResource;
use App\Http\Resources\PhotoGallery\PhotoGalleryCollection;
use App\Models\PhotoGallery;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photosGallery = PhotoGallery::whereHas('gallery', function ($photosGalleryEstatus) {
                $photosGalleryEstatus->where('status', 1);
            })->where('gallery_id', $id)->paginate(10);

            return new PhotoGalleryCollection($photosGallery);
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoGalleryRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photoGallery = PhotoGallery::create($request->except(['type', 'base']));
            
            if (!is_null($request->base)) {
                // evento
            }
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PhotoGallery $photoGallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            PhotoGalleryResource::withoutWrapping();
            return new PhotoGalleryResource($photoGallery);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoGalleryRequest $request, PhotoGallery $photoGallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photoGallery->update($request->except(['type', 'base']));
            
            if (!is_null($request->base)) {
                // evento
            }
            
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhotoGallery  $photoGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PhotoGallery $photoGallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photoGallery->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
