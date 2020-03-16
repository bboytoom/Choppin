<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductRepository
{
    public function createProduct(Request $request)
    {
        try {
            Product::create([
                'subcategory_id' => $request->subcategory_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'extract' => e(strtolower($request->extract)),
                'description' => e(strtolower($request->description)),
                'price' => $request->price,
                'status' => 1
            ]);

            Log::notice('El producto ' . $request->name . ' se creo correctamente');

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al crear el producto ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::find($id);
     
        if(is_null($product)) {
            return 422;
        }

        try {
            Product::where('id', $product->id)->update([
                'subcategory_id' => $request->subcategory_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'extract' => e(strtolower($request->extract)),
                'description' => e(strtolower($request->description)),
                'price' => $request->price,
                'status' => $request->status
            ]);

            Log::notice('El producto ' . $request->name . ' se actualizo correctamente');

            return 200;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el producto ' . $request->name . ', ya que muestra la siguiente Exception ' . $e);
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        
        if(is_null($product)) {
            return 422;
        }

        $product->delete();
        
        Log::notice('El producto ' . $product->name . ' se elimino correctamente');

        return 204;
    }
}
