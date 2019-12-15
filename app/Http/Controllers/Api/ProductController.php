<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $products = Product::create([
            'admin_id' => $request->get('admin_id'),
            'category_id' => $request->get('category_id'),
            'subcategory_id' => $request->get('subcategory_id'),
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name'), '-'),
            'extract' => $request->get('extract'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'image' => $request->get('image'),
            'status' => $request->get('status')
        ]);

        return response()->json(
        [
            'data' => [
                'category' => [
                    'name' => $products->name
                ]
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Product::find($id);

        ProductResource::withoutWrapping();
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product =  Product::find($id);
        $product->category_id = $request->get('category_id');
        $product->subcategory_id = $request->get('subcategory_id');
        $product->name = $request->get('name');
        $product->slug = Str::slug($request->get('name'), '-');
        $product->extract = $request->get('extract');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->image = $request->get('image');
        $product->status = $request->get('status');
        $product->save();

        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =  Product::find($id);
        $product->delete();

        return response(null, 204);
    }
}
