<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Store\IndexCollection;
use App\Http\Resources\Store\StoreProductResource;
use App\Models\Product;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $products = Product::all()->where('status', 1)->random(6);
            return new IndexCollection($products);
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
    public function show(Request $request, Product $store)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            StoreProductResource::withoutWrapping();
            return new StoreProductResource($store);
        } else {
            abort(401);
        }
    }
}
