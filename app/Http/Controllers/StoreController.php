<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use App\Unidades;

class StoreController extends Controller
{
    public function index()
    {
    	$products = Product::all();
        
    	return view('store.index', [
            'products' => $products
         ]);
    }

    public function show($slug)
    {
    	$product = Product::where('slug', $slug)->first();
        $categoria = Category::find($product->category_id);
        $unidades = Unidades::find($product->unidad_id);

    	return view('store.show', [
            'product' => $product,
            'categoria' => $categoria,
            'unidades' => $unidades
        ]);
    }
}