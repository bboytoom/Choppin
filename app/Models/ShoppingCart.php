<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shoppingcart';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ["status"];

    public function inShoppingCarts()
    {
        return $this->hasMany("App\Models\InShoppingCart");
    }
    
    public function product()
    {
        return $this->belongsToMany("App\Models\Product", "in_shopping_carts");
    }
    
    public function order()
    {
        return $this->hasOne("App\Models\Order")->first();
    }
}
