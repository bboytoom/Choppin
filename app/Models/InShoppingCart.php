<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
    protected $table = 'in_shopping_carts';

    protected $fillable = [
        'shopping_cart_id',
        'product_id',
        'qty'
    ];
}
