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
    protected $table = 'inshoppingcart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 
        'shopping_cart_id',
    ];
}
