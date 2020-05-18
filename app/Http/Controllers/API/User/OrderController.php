<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCarts;
use App\Models\Orders;

class OrderController extends Controller
{
    private $pages = 10;

    public function index()
    {
        $carts = array();
        $user = Auth::user();
        $shopping_cart = ShoppingCarts::where('id', $user->id)->get();

        if ($shopping_cart) {
            return response(null, 204);
        }

        foreach ($shopping_cart as $item) {
            array_push($carts, $item->id);
        }

        $orders = Orders::whereIn('shopping_cart_id', $carts)->paginate($this->pages);

        return new OrderCollection($orders);
    }

    public function show(Orders $order)
    {
        OrderResource::withoutWrapping();
        return new OrderResource($order);
    }
}
