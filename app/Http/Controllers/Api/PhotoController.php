<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\Photo\PhotoResource;
use App\Http\Resources\Photo\PhotoCollection;
use App\Events\PhotoImageUpdated;
use App\Models\Photo;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $photos = Photo::whereHas('product', function ($photosEstatus) {
                $photosEstatus->where('status', 1); 
            })->where('product_id', $id)->paginate(10);

            return new PhotoCollection($photos);
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
    public function store(PhotoRequest $request)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $photo = Photo::create($request->except(['type', 'base']));
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
            
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
    public function show(Request $request, Photo $photo)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            PhotoResource::withoutWrapping();
            return new PhotoResource($photo);
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
    public function update(PhotoRequest $request, Photo $photo)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $photo->update($request->except(['type', 'base']));
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));

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
    public function destroy(Request $request, Photo $photo)
    {
        if (config('app.key') == $request->header('APP_KEY')) {
            $photo->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
