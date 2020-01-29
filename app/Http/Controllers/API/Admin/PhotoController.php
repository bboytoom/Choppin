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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $photos = Photo::whereHas('product', function ($photosEstatus) {
            $photosEstatus->where('status', 1);
        })->where('product_id', $id)->paginate(10);

        return new PhotoCollection($photos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        $photo = Photo::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }

        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        PhotoResource::withoutWrapping();
        return new PhotoResource($photo);
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
        $photo->update($request->except(['type', 'base']));
            
        if (!is_null($request->base)) {
            event(new PhotoImageUpdated($photo->id, $photo->image, $request->base, $request->type));
        }
            
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return response(null, 204);
    }
}
