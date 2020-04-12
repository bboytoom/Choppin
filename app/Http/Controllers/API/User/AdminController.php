<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Paypal;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('shoppingcart')->only('store');
    }

    public function index()
    {
        return response(null, 200);
    }

    public function store(Request $request)
    {
        $shoppingcart = $request->shopping_cart;

        $payment = new Paypal($shoppingcart, $request->shippins);
        $response = $payment->generate();

        return response([
            'url' => $response->getApprovalLink()
        ], 202);
    }

    public function buy(Request $request)
    {
        $shoppingcart = $request->shopping_cart;

        $payment = new Paypal($shoppingcart, 0);
        $response = $payment->execute($request->paymentId, $request->PayerID);

        if($response->state == 'approved') {
            dd($response);
        }

        return response(null, 500);
    }
}
