<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Caracteristica;
use App\Models\PhotosGallery;

class StoreController extends Controller
{
    public function index()
    {
        $galeria = PhotosGallery::all();
        $products = Product::all();
        
        if($products->count() >= 6)
            $products = $products->random(6);
        
    	return view('store.index', [
            'products' => $products,
            'galeria' => $galeria
         ]);
    }

    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
        $categoria = Category::find($product->category_id);
        $caracteristicas = Caracteristica::where('producto_id', $product->id)->get();
        
    	return view('store.show', [
            'product' => $product,
            'categoria' => $categoria,
            'caracteristicas' => $caracteristicas
        ]);
    }
}