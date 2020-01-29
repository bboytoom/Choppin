<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoSlideRequest;
use App\Http\Resources\PhotoSlide\PhotoSlideResource;
use App\Http\Resources\PhotoSlide\PhotoSlideCollection;
use App\Events\PhotoSlideUpdate;
use App\Models\PhotoSlide;

class PhotoSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $photosSlide = PhotoSlide::whereHas('configuration', function ($photosSlideEstatus) {
            $photosSlideEstatus->where('status', 1);
        })->paginate(5);

        return new PhotoSlideCollection($photosSlide);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoSlideRequest $request)
    {
        $photoslide = PhotoSlide::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($photoslide->id, $photoslide->image, $request->base, $request->type));
        }

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhotoSlide  $photoSlide
     * @return \Illuminate\Http\Response
     */
    public function show(PhotoSlide $photoslide)
    {
        PhotoSlideResource::withoutWrapping();
        return new PhotoSlideResource($photoslide);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PhotoSlide  $photoSlide
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoSlideRequest $request, PhotoSlide $photoslide)
    {
        $photoslide->update($request->except(['type', 'base']));
    
        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($photoslide->id, $photoslide->image, $request->base, $request->type));
        }

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhotoSlide  $photoSlide
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotoSlide $photoslide)
    {
        $photoslide->delete();
        return response(null, 204);
    }
}
