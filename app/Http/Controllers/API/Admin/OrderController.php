<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Http\Resources\Order\OrderCollection;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrderController extends Controller
{
    private $pages = 10;

    public function index()
    {
        return new OrderCollection(Orders::paginate($this->pages));
    }

    public function show(Orders $order)
    {
        OrderResource::withoutWrapping();
        return new OrderResource($order);
    }

    public function update(Request $request, Orders $order)
    {
        //
    }
}
