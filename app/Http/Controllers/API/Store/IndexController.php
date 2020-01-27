<?php

namespace App\Http\Controllers\API\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Store\IndexCollection;
use App\Http\Resources\Store\StoreProductResource;
use App\Models\Product;
use App\Models\InShoppingCart;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware("shoppingcart")->only('store');
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            $shoppingcart = $request->shopping_cart;
            
            InShoppingCart::create([
                'shopping_cart_id' => $shoppingcart->id,
                'product_id' => $request->product_id
            ]);

            return response(null, 200);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $identity, $product_id)
    {
        if (config('app.key') == $request->header('x-api-key')) {
            return response(null, 204);
        } else {
            abort(401);
        }
    }
}
