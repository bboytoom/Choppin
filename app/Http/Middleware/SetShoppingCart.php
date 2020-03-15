<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ShoppingCarts;

class SetShoppingCart
{
    public function handle($request, Closure $next)
    {
        $shopping_cart = ShoppingCarts::findOrCreateShoppingCart($request->identity);
        $request->shopping_cart = $shopping_cart;

        return $next($request);
    }
}
