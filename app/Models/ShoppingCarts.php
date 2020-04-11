<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCarts extends Model
{
    protected $table = 'shopping_carts';

    protected $fillable = [
        'indentity',
        'email',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'in_shopping_carts', 'shopping_cart_id'); 
    }

    public static function findOrCreateShoppingCart($indentity, $email, $qty) 
    {
        $cart = ShoppingCarts::where('indentity', $indentity)->first();

        if(is_null($cart)) {
            return ShoppingCarts::createWithoutIdentity($indentity, $email, $qty);
        } else {
            return $cart;
        }
    }

    public static function createWithoutIdentity($indentity, $email, $qty) 
    {
        try {
            return ShoppingCarts::create([
                'indentity' => $indentity,
                'email' => $email,
                'status' => 0
            ]);

            Log::notice('Se guardo el carrito ' . $indentity . ' correctamente');
        } catch (\Exception $e) {
            Log::error('Error al ingresar al carrito ' . $indentity . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }
}
