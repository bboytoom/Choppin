<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCarts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shopping_carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
