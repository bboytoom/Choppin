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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $gallery = Gallery::whereHas('category', function ($galleryEstatus) {
                $galleryEstatus->where('status', 1); 
            })->paginate(10);

            return new GalleryCollection($gallery);
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
    public function store(GalleryRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            Gallery::create($request->all());
            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Gallery $gallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            GalleryResource::withoutWrapping();
            return new GalleryResource($gallery);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, Gallery $gallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $gallery->update($request->all());
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $gallery->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
