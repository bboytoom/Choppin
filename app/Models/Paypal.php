<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ShoppingCarts;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payer;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Exception\PayPalConnectionException;

class Paypal extends Model
{
    private $_api_context;
    private $_shoppingcart;

    public function __construct($shoppingcart)
    {
        $paypal_conf = \Config::get('Paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->_shoppingcart = $shoppingcart;
    }

    public function payer()
    {
        $payer = new Payer();
        return $payer->setPaymentMethod('paypal');
    }

    public function items()
    {
        $items = [];
        $products = $this->_shoppingcart->products()->get();

        foreach ($products as $product) {
            array_push(
                $items,
                $product->paypalItem(
                    $product->quantity()->first()
                )
            );
        }

        $item_list = new ItemList();
        return $item_list->setItems($items);
    }

    public function details()
    {
        $subtotal = 0;
        $shipping = 0;
        $products = $this->_shoppingcart->products()->get();
        
        $details = new Details();

        foreach ($products as $product) {
            $quantity = $product->quantity()->first();
            $subtotal += $product->price *  $quantity->qty;
        }

        return [
            'total' => $subtotal + $shipping,
            'detail' => $details->setSubtotal($subtotal)->setShipping($shipping)
        ];
    }

    public function amount()
    {
        $details = $this->details();

        $amount = new Amount();
        $paypal_conf = \Config::get('Paypal');

        return $amount->setCurrency($paypal_conf['currency'])
			->setTotal($details['total'])
            ->setDetails($details['detail']);
    }

    public function transaction()
    {
        $transaction = new Transaction();

        return $transaction->setItemList($this->items())
            ->setAmount($this->amount())
            ->setDescription('Compra en shoppin')
            ->setInvoiceNumber(uniqid());
    }

    public function redirectURLs()
    {
        $redirect_urls = new RedirectUrls();
        $baseURL = url('/');

        return $redirect_urls->setReturnUrl("$baseURL/api/v1/user/payment")->setCancelUrl("$baseURL/api/v1/store");
    }

    public function generate()
    {
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($this->payer())
            ->setTransactions([$this->transaction()])
            ->setRedirectUrls($this->redirectURLs());

        try
        {
            $payment->create($this->_api_context);
        }
        catch(PayPalConnectionException $ex)
        {
            dd($ex->getData());
        }

        return $payment;
    }

    public function execute($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        
        return $payment->execute($execution, $this->_api_context);
    }
}
