<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductRepository
{
    public function createProduct(Request $request)
    {
        Product::create($request->all());
        return 201;
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
     
        if($product) {
            return 422;
        }

        Product::where('id', $request->id)->update($request->all());
        return 200;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        
        if(is_null($product)) {
            return 422;
        }

        $product->delete();
        return 204;
    }
}
