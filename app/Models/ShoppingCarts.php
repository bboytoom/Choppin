<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCarts extends Model
{
    protected $table = 'shopping_carts';

    protected $fillable = [
        'user_id',
        'coupon_id',
        'indentity',
        'status'
    ];

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'in_shopping_carts', 'shopping_cart_id');
    }

    public static function findOrCreateShoppingCart($indentity, $user_id)
    {
        $cart = ShoppingCarts::where('indentity', $indentity)->first();

        if (is_null($cart)) {
            return ShoppingCarts::createWithoutIdentity($indentity, $user_id);
        } else {
            return $cart;
        }
    }

    public static function createWithoutIdentity($indentity, $user_id)
    {
        try {
            return ShoppingCarts::create([
                'user_id' => $user_id,
                'indentity' => $indentity,
                'status' => 0
            ]);
        } catch (\Exception $e) {
            Log::error('Error al ingresar al carrito ' . $indentity . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }
}
