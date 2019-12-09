<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shopping_cart_id',
        'guide_numer', 
        'total', 
        'status', 
    ];

    public function shopping_cart()
    {
        return $this->belongsTo('App\Models\ShoppingCart');
    }
}
