<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;
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
            'subcategory_id' => $request->get('subcategory_id'),
            'name' => strip_tags($request->get('name')),
            'slug' => Str::slug($request->get('name'), '-'),
            'extract' => strip_tags($request->get('extract')),
            'description' => strip_tags($request->get('description')),
            'price' => strip_tags(strip_tags($request->get('price'))),
            'status' => $request->get('status')
        ]);

        return response()->json(
            [
                'data' => [
                    'product' => [
                        'name' => $products->name
                    ]
                ]
            ],
            201
        );
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

        if ($product == null) {
            return response(null, 404);
        }

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

        if ($product == null) {
            return response(null, 404);
        }

        $product->subcategory_id = $request->get('subcategory_id');
        $product->name = strip_tags($request->get('name'));
        $product->slug = Str::slug($request->get('name'), '-');
        $product->extract = strip_tags($request->get('extract'));
        $product->description = strip_tags($request->get('description'));
        $product->price = strip_tags($request->get('price'));
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

        if ($product == null) {
            return response(null, 404);
        }
        
        $product->delete();

        return response(null, 204);
    }
}
