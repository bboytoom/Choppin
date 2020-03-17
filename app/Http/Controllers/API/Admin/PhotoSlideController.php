<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoSlideRequest;
use App\Http\Resources\PhotoSlide\PhotoSlideResource;
use App\Http\Resources\PhotoSlide\PhotoSlideCollection;
use App\Repositories\PhotoSlideRepository;
use App\Models\PhotoSlide;

class PhotoSlideController extends Controller
{
    protected $photo;
    private $pages = 5;

    public function __construct(PhotoSlideRepository $photo)
    {
        $this->photo = $photo;
    }

    public function index($id)
    {
        $photosSlide = PhotoSlide::whereHas('configuration', function ($photosSlideEstatus) {
            $photosSlideEstatus->where('status', 1);
        })->paginate($this->pages);

        return new PhotoSlideCollection($photosSlide);
    }

    public function store(PhotoSlideRequest $request)
    {
        return response(null, $this->photo->createPhotoSlide($request));
    }

    public function show($id)
    {
        $slide = PhotoSlide::findOrFail($id);

        PhotoSlideResource::withoutWrapping();
        return new PhotoSlideResource($slide);
    }

    public function update(PhotoSlideRequest $request, $id)
    {
        return response(null, $this->photo->updatePhotoSlide($request, $id));
    }

    public function destroy($id)
    {
        return response(null, $this->photo->deletePhotoSlide($id));
    }
}
