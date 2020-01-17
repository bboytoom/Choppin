<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoGalleryRequest;
use App\Http\Resources\PhotoGallery\PhotoGalleryResource;
use App\Http\Resources\PhotoGallery\PhotoGalleryCollection;
use App\Events\PhotoGalleryUpdate;
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
            $photosgallery = PhotoGallery::create($request->except(['type', 'base']));

            if (!is_null($request->base)) {
                event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
            }

            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PhotoGallery $photosgallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            PhotoGalleryResource::withoutWrapping();
            return new PhotoGalleryResource($photosgallery);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoGalleryRequest $request, PhotoGallery $photosgallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photosgallery->update($request->except(['type', 'base']));

            if (!is_null($request->base)) {
                event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
            }

            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PhotoGallery $photosgallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $photosgallery->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
