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
    public function __construct()
    {
        $this->middleware("authheader");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $photosGallery = PhotoGallery::whereHas('gallery', function ($photosGalleryEstatus) {
            $photosGalleryEstatus->where('status', 1);
        })->where('gallery_id', $id)->paginate(10);

        return new PhotoGalleryCollection($photosGallery);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoGalleryRequest $request)
    {
        $photosgallery = PhotoGallery::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
        }

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoGallery $photosgallery)
    {
        PhotoGalleryResource::withoutWrapping();
        return new PhotoGalleryResource($photosgallery);
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
        $photosgallery->update($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoGalleryUpdate($photosgallery->id, $photosgallery->image, $request->base, $request->type));
        }

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoGallery $photosgallery)
    {
        $photosgallery->delete();
        return response(null, 204);
    }
}
