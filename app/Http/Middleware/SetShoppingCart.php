<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingCarts;
use App\Models\Coupon;
use App\Models\CouponAssigned;

class SetShoppingCart
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
 
            if (is_null($request->coupon)) {
                $coupon_id = 1;
            } else {
                $today = today();
                $findCoupon = Coupon::firstWhere('name', $request->coupon);

                if (is_null($findCoupon) || $findCoupon->expiration_finish < $today) {
                    return response(null, 422);
                }

                $coupon_id = $findCoupon->id;

                $couponAssigned = CouponAssigned::create([
                    'user_id' => $user->id,
                    'coupon_id' => $coupon_id
                ]);

                if (!$couponAssigned) {
                    Log::warning('No se agrego la asignacion del cupon ' .  $coupon_id . ' con el usuario ' . $user->id);
                    return response(null, 400);
                }
            }

            $shopping_cart = ShoppingCarts::findOrCreateShoppingCart($request->identity, $user->id, $coupon_id);
            $request->shopping_cart = $shopping_cart;

            return $next($request);
        }

        return response(null, 401);
    }
}
