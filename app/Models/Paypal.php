<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Configuration;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\ShippingAddress;
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
    private $_shipping_id;

    public function __construct($shoppingcart, $shipping_id)
    {
        $paypal_conf = \Config::get('Paypal');

        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->_shoppingcart = $shoppingcart;
        $this->_shipping_id = $shipping_id;
    }

    public function payer()
    {
        $payer = new Payer();
        return $payer->setPaymentMethod('paypal');
    }

    public function address()
    {
        $address = new ShippingAddress();

        $shippings = User::firstWhere('email', $this->_shoppingcart->email)->shipping();
        $find_addres = $shippings->find($this->_shipping_id);

        return $address->setLine1($find_addres->addres)
            ->setLine2($find_addres->street_one)
            ->setCity($find_addres->town)
            ->setState($find_addres->state)
            ->setCountryCode($find_addres->country_code)
            ->setPostalCode($find_addres->postal_code)
            ->setRecipientName($find_addres->name);
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
        return $item_list->setItems($items)
            ->setShippingAddress($this->address());
    }

    public function details()
    {
        $subtotal = 0;
        $shipping = Configuration::where('domain', $_SERVER['HTTP_HOST'])->first();
        $details = new Details();

        if (is_null($shipping)) {
            return [
                'answer' => 'error',
                'total' => 0,
                'detail' => $details->setSubtotal(0)
            ];
        }

        $products = $this->_shoppingcart->products()->get();

        foreach ($products as $product) {
            $quantity = $product->quantity()->first();
            $subtotal += $product->price *  $quantity->qty;
        }

        return [
            'answer' => 'ok',
            'total' => $subtotal + $shipping->cost_shipping,
            'detail' => $details->setSubtotal($subtotal)->setShipping($shipping->cost_shipping)
        ];
    }

    public function amount()
    {
        $details = $this->details();

        $amount = new Amount();
        $paypal_conf = \Config::get('Paypal');

        return [
            'answer' => $details['answer'],
            'amount' => $amount->setCurrency($paypal_conf['currency'])
                ->setTotal($details['total'])
                ->setDetails($details['detail'])
        ];
    }

    public function transaction()
    {
        $amount = $this->amount();
        $transaction = new Transaction();

        return [
            'answer' => $amount['answer'],
            'transaction' => $transaction->setItemList($this->items())
                ->setAmount($amount['amount'])
                ->setDescription('Compra en shoppin')
                ->setInvoiceNumber(uniqid())
        ];
    }

    public function redirectURLs()
    {
        $redirect_urls = new RedirectUrls();
        $baseURL = url('/');

        return $redirect_urls->setReturnUrl("$baseURL/api/v1/user/payment?shoppingCart=".$this->_shoppingcart->indentity."&shippingCart=".$this->_shipping_id)
            ->setCancelUrl("$baseURL/api/v1/store");
    }

    public function generate()
    {
        $transaction = $this->transaction();

        if ($transaction['answer'] == 'error') {
            return null;
        }

        try {
            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($this->payer())
                ->setTransactions([$transaction['transaction']])
                ->setRedirectUrls($this->redirectURLs());

            try {
                $payment->create($this->_api_context);
            } catch (PayPalConnectionException $ex) {
                dd($ex->getData());
            }

            return $payment;
        } catch (\Exception $e) {
            Log::error('Error al crear la compra, ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    public function execute($paymentId, $payerId)
    {
        $payment = Payment::get($paymentId, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        return $payment->execute($execution, $this->_api_context);
    }
}
