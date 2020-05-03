<?php

namespace App\Http\Controllers\API\User;

use Illuminate\Http\Request;
use App\Http\Requests\BuyRequest;
use App\Http\Controllers\Controller;
use App\Models\ShoppingCarts;
use App\Models\PaypalPayments;
use App\Models\Orders;
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

        if (is_null($response)) {
            return response(null, 500);
        }

        return response([
            'url' => $response->getApprovalLink()
        ], 202);
    }

    public function buy(BuyRequest $request)
    {
        $payment = new Paypal(null, 0);
        $response = $payment->execute($request->paymentId, $request->PayerID);

        if ($response->state != 'approved') {
            return response(null, 406);
        }

        $cart = ShoppingCarts::firstWhere('indentity', $request->shoppingCart);

        if (is_null($cart)) {
            return response(null, 204);
        }

        $cart->status = 1;
        $cart->save();

        $paypal_payment = PaypalPayments::create([
            'payment_id' => $request->paymentId,
            'payer_id' => $request->PayerID,
            'token' => $request->token,
            'state' => $response->state
        ]);

        $order = Orders::create([
            'paypal_id' => $paypal_payment->id,
            'shopping_cart_id' => $cart->id,
            'shipping_address_id' => $request->shippingCart,
            'status' => 0
        ]);

        return response(null, 202);
    }
}
