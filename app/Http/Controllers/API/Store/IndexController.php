<?php

namespace App\Http\Controllers\API\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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

        try {
            foreach($request->cart as $products) {
                $inshop = InShoppingCart::create([
                    'shopping_cart_id' => $shoppingcart->id,
                    'product_id' => $products['id'],
                    'qty' => $products['qty']
                ]);

                if (!$inshop) {
                    Log::warning('No se guardo la compra del producto ' . $products['id'] . ' ' . $shoppingcart->id);
                    return response(null, 400);
                }

                Log::notice('Se guardo la compra del producto ' . $products['id'] . ' ' . $shoppingcart->id . ' correctamente');
            }

            return response(null, 200);
        } catch (\Exception $e) {
            Log::error('Error al generar la compra del siguiente producto ' . $products['id'] . ' ' . $shoppingcart->id . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function show(Product $store)
    {
        StoreProductResource::withoutWrapping();
        return new StoreProductResource($store);
    }
}
