<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'in_shopping_carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shopping_cart_id',
        'product_id'
    ];
}
