<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Caracteristica;
use App\PhotosGallery;

class StoreController extends Controller
{
    public function index()
    {
    	$products = Product::all();
        $galeria = PhotosGallery::all();
        
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