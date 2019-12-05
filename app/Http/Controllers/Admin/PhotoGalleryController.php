<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Requests\SaveGalleryRequest;
use App\Http\Controllers\Controller;
use App\Models\PhotosGallery;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = PhotosGallery::all();

        return view('admin.photogallery.index', [
            'photos' => $photos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photogallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveGalleryRequest $request)
    {
        if($request->file('image'))
        {
            $path = public_path().'/gallery_img/';
            $nameImage = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path, $nameImage);
        }

        $data = [
            'title' => $request->get('title'),
            'image' => $nameImage,
            'status' => $request->has('status') ? 1 : 0,
            'description' => $request->get('description')
        ];

        $gallery = PhotosGallery::create($data);
  
        return redirect()->route('admin.photogallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PhotosGallery $gallery)
    {
        return $gallery;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PhotosGallery $gallery)
    {
        return view('admin.photogallery.edit', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveGalleryRequest $request, PhotosGallery $gallery)
    {
        $nameImage = null;

        if($request->file('image'))
        {
            $path = public_path().'/gallery_img/';
            $nameImage = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path, $nameImage);
        }
        else
        {   
            $imagenactual = PhotosGallery::find($gallery->id);
            $nameImage = $imagenactual->image;
        }
        
        $gallery->fill($request->all());
        $gallery->image = $nameImage;
        $gallery->status = $request->has('status') ? 1 : 0;
        $updated = $gallery->save();
        
        return redirect()->route('admin.photogallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhotosGallery $gallery)
    {
        $deleted = $gallery->delete();
        
        return redirect()->route('admin.photogallery.index');
    }
}