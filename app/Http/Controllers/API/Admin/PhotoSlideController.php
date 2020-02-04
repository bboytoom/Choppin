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
    public function index($id)
    {
        $photosSlide = PhotoSlide::whereHas('configuration', function ($photosSlideEstatus) {
            $photosSlideEstatus->where('status', 1);
        })->paginate(5);

        return new PhotoSlideCollection($photosSlide);
    }

    public function store(PhotoSlideRequest $request)
    {
        $photoslide = PhotoSlide::create($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($photoslide->id, $photoslide->image, $request->base, $request->type));
        }

        return response([
            'message' => 'Se agrego correctamente'
        ], 201);
    }

    public function show(PhotoSlide $slide)
    {
        PhotoSlideResource::withoutWrapping();
        return new PhotoSlideResource($slide);
    }

    public function update(PhotoSlideRequest $request, PhotoSlide $slide)
    {
        $slide->update($request->except(['type', 'base']));

        if (!is_null($request->base)) {
            event(new PhotoSlideUpdate($slide->id, $slide->image, $request->base, $request->type));
        }

        return response([
            'message' => 'Se actualizò correctamente'
        ], 200);
    }

    public function destroy(PhotoSlide $slide)
    {
        $slide->delete();
        return response([
            'message' => 'Se elimino correctamente'
        ], 204);
    }
}
