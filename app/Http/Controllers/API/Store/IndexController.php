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
    private $pages = 10;

    public function __construct()
    {
        $this->middleware('shoppingcart')->only('store');
    }

    public function index()
    {
        $products = Product::all()->where('status', 1);

        if ($products->count() > 6) {
            return new IndexCollection($products->random($this->pages));
        }

        return new IndexCollection($products);
    }

    public function store(Request $request)
    {
        $shoppingcart = $request->shopping_cart;
            
        InShoppingCart::create([
            'shopping_cart_id' => $shoppingcart->id,
            'product_id' => $request->product_id
        ]);

        return response(null, 200);
    }

    public function show(Product $store)
    {
        StoreProductResource::withoutWrapping();
        return new StoreProductResource($store);
    }
}
