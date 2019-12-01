<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PhotosGallery;

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
    public function store(Request $request)
    {
        $this->validate($request, [
          'title' => 'required|max:100',
        ]);

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
        
        $message = $gallery ? 'Imagen agregada correctamente!' : 'La imagen NO pudo agregarse!';
        
        return redirect()->route('admin.photogallery.index')->with('message', $message);
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
    public function update(Request $request, PhotosGallery $gallery)
    {
        $nameImage = null;

        $this->validate($request, [
          'title' => 'required|max:100',
        ]);

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
        
        $message = $updated ? 'Imagen actualizado correctamente!' : 'El imagen NO pudo actualizarse!';
        
        return redirect()->route('admin.photogallery.index')->with('message', $message);
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
        
        $message = $deleted ? 'Imagen eliminada correctamente!' : 'La imagen NO pudo eliminarse!';
        
        return redirect()->route('admin.photogallery.index')->with('message', $message);
    }
}