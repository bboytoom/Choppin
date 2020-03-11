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

    public static function findOrCreateShoppingCart($indentity) 
    {
        $cart = ShoppingCarts::where('indentity', $indentity)->first();

        if(is_null($cart)) {
            return ShoppingCarts:: createWithoutIdentity($indentity);
        } else {
            return $cart;
        }
    }

    public static function createWithoutIdentity($indentity) 
    {
        return ShoppingCarts::create([
            'indentity' => $indentity,
            'status' => 0
        ]);
    }
}
