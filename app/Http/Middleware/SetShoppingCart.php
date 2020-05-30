<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCarts;

class SetShoppingCart
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $shopping_cart = ShoppingCarts::findOrCreateShoppingCart($request->identity, $user->id);
            $request->shopping_cart = $shopping_cart;

            return $next($request);
        }

        return response(null, 401);
    }
}
