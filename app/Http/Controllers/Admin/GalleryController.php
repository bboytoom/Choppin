<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class GalleryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallery.index');
    }

    public function edit($id)
    {
        $gallery =  Gallery::findOrFail(base64_decode($id));

        return view('admin.gallery.edit', [
            'id' => $gallery['id'],
            'name' => $gallery['name']
        ]);
    }
}
