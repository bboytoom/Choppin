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

    public function index()
    {
        $products = Product::whereHas('subcategory', function ($productsEstatus) {
            $productsEstatus->where('status', 1); 
        })->paginate(10);

        return new ProductCollection($products);
    }

    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        return response(null, 201);
    }

    public function show(Product $product)
    {
        ProductResource::withoutWrapping();
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return response(null, 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(null, 204);
    }
}
