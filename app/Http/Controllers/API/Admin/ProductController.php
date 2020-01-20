<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $products = Product::whereHas('subcategory', function ($productsEstatus) {
                $productsEstatus->where('status', 1); 
            })->paginate(10);

            return new ProductCollection($products);
        } else {
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if (config('app.key') == $request->header('x-api-key')) { 
            Product::create($request->all());
            return response(null, 201);
        } else {
            abort(401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            ProductResource::withoutWrapping();
            return new ProductResource($product);
        } else {
            abort(401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $product->update($request->all());
            return response(null, 200);
        } else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $product->delete();
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
