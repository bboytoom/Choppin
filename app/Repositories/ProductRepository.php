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
            $product = Product::create([
                'subcategory_id' => $request->subcategory_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'extract' => e(strtolower($request->extract)),
                'description' => e(strtolower($request->description)),
                'stock' => $request->stock,
                'price' => $request->price,
                'status' => 1
            ]);

            if ($product) {
                Log::notice('El producto ' . $request->name . ' se creo correctamente');
                return 201;
            }

            Log::warning('El producto ' . $request->name . ' no se creo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al crear el producto ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function updateProduct(Request $request, $product)
    {
        try {
            $productEdit = Product::where('id', $product->id)->update([
                'subcategory_id' => $request->subcategory_id,
                'name' => e(strtolower($request->name)),
                'slug' => \Str::slug($request->name, '-'),
                'extract' => e(strtolower($request->extract)),
                'description' => e(strtolower($request->description)),
                'price' => $request->price,
                'status' => $request->status
            ]);

            if ($productEdit) {
                Log::notice('El producto ' . $request->name . ' se actualizo correctamente');
                return 200;
            }

            Log::warning('El producto ' . $request->name . ' no se actualizo');
            return 400;
        } catch (\Exception $e) {
            Log::error('Error al actualizar el producto ' . $request->name . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function deleteProduct($product)
    {
        $productDelete = $product->delete();   
        
        if ($productDelete) {
            Log::notice('El producto ' . $product->name . ' se elimino correctamente');
            return 204;
        }
        
        Log::warning('El producto ' . $request->name . ' no se elimino');
        return 400;
    }
}
