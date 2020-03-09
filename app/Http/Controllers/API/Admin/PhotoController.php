<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PhotoRequest;
use App\Http\Resources\Photo\PhotoResource;
use App\Http\Resources\Photo\PhotoCollection;
use App\Repositories\PhotoRepository;
use App\Models\Photo;

class PhotoController extends Controller
{
    protected $phto;

    public function __construct(PhotoRepository $phto)
    {
        $this->phto = $phto;
    }

    public function index($id)
    {
        $photos = Photo::whereHas('product', function ($photosEstatus) {
            $photosEstatus->where('status', 1);
        })->where('product_id', $id)->paginate(10);

        return new PhotoCollection($photos);
    }

    public function store(PhotoRequest $request)
    {
        return response(null, $this->phto->createPhoto($request));
    }

    public function show(Photo $photo)
    {
        PhotoResource::withoutWrapping();
        return new PhotoResource($photo);
    }

    public function update(PhotoRequest $request, $id)
    {
        return response(null, $this->phto->updatePhoto($request, $id));
    }

    public function destroy($id)
    {
        return response(null, $this->phto->deletePhoto($id));
    }
}
