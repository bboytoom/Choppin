<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id)
    {
        $category_products = Product::where('category_id', $category_id)->get();
        $category_name = Category::find($category_id);

        return view('store.categories', [
            'category_products' => $category_products,
            'category_name' => $category_name
        ]);
    }
}