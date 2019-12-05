<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Requests\SaveProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unidades;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
       
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
        
        return view('admin.product.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SaveProductRequest $request)
    {
        if($request->file('image'))
        {
            $path = public_path().'/products_img/';
            $nameImage = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path, $nameImage);
        }
        else
        {
            $nameImage = 'default.jpg';
        }

        $data = [
            'name' => $request->get('name'),
            'slug' => str_slug($request->get('name')),
            'description' => $request->get('description'),
            'extract' => $request->get('extract'),
            'price' => $request->get('price'),
            'image' => $nameImage,
            'visible' => $request->has('visible') ? 1 : 0,
            'category_id' => $request->get('category_id')
        ];

        $product = Product::create($data);

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->lists('name', 'id');
        
        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SaveProductRequest $request, Product $product)
    {
        
        $nameImage = null;

        if($request->file('image'))
        {
            $path = public_path().'/products_img/';
            $nameImage = $request->file('image')->getClientOriginalName();
            $request->file('image')->move($path, $nameImage);
        }
        else
        {
            $ImagenActual = Product::find($product->id);
            $nameImage = $ImagenActual->image;
        }

        $product->fill($request->all());
        $product->slug = str_slug($request->get('name'));
        $product->image = $nameImage;
        $product->visible = $request->has('visible') ? 1 : 0;
        $updated = $product->save();
        
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        
        return redirect()->route('admin.product.index');
    }
}
