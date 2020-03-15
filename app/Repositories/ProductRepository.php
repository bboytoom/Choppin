<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductRepository
{
    public function createProduct(Request $request)
    {
        Product::create([
            'subcategory_id' => $request->subcategory_id,
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'extract' => e(strtolower($request->extract)),
            'description' => e(strtolower($request->description)),
            'price' => $request->price,
            'status' => 1
        ]);

        return 201;
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
     
        if(is_null($product)) {
            return 422;
        }

        Product::where('id', $product->id)->update([
            'subcategory_id' => $request->subcategory_id,
            'name' => e(strtolower($request->name)),
            'slug' => \Str::slug($request->name, '-'),
            'extract' => e(strtolower($request->extract)),
            'description' => e(strtolower($request->description)),
            'price' => $request->price,
            'status' => $request->status
        
        ]);

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
