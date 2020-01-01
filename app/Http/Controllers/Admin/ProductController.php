<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
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
        return view('admin.products.index');
    }

    public function edit($id)
    {
        $product =  Product::find(base64_decode($id));

        if ($product == null) {
            return abort(404);
        }

        return view('admin.products.edit', [
            'id' => $product['id'],
            'name' => $product['name']
        ]);
    }
}
