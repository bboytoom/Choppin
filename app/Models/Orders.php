<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'paypal_id',
        'shopping_cart_id',
        'shipping_address',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function paypal_payment()
    {
        return $this->belongsTo('App\Models\PaypalPayments', 'paypal_id');
    }

    public function shopping_carts()
    {
        return $this->belongsTo('App\Models\ShoppingCarts', 'shopping_cart_id');
    }
}
