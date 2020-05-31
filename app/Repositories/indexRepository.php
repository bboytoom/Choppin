<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\ShoppingCarts;
use App\Models\InShoppingCart;
use App\Models\Coupon;
use App\Models\CouponAssigned;

class indexRepository
{
    public function createShopping(Request $request, $shoppingcart)
    {
        $InshoppingShow = InShoppingCart::where('shopping_cart_id', $shoppingcart->id)->get();

        if (count($InshoppingShow) == 0) {
            $this->createCoupon($request->cart, $shoppingcart->id);
        } else {
            $deleteInshopping = InShoppingCart::where('shopping_cart_id', $shoppingcart->id)->delete();
            $this->createCoupon($request->cart, $shoppingcart->id);
        }

        if (!is_null($request->coupon)) {
            return $this->coupon($request->coupon, $shoppingcart->id);
        }

        return 201;
    }

    private function createCoupon($cart, $shoppingCart_id)
    {
        try {
            foreach ($cart as $products) {
                $createInshopping = InShoppingCart::create([
                    'shopping_cart_id' => $shoppingCart_id,
                    'product_id' => $products['id'],
                    'qty' => $products['qty']
                ]);

                if (!$createInshopping) {
                    Log::warning('No se guardo la compra del producto ' . $products['id'] . ' ' . $shoppingCart_id);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error al generar la compra del siguiente producto '  . $e->getMessage());
        }
    }

    private function coupon($coupon, $shoppingCart_id)
    {
        $user_id = Auth::id();
        $today = today();

        $findCoupon = Coupon::firstWhere('name', $coupon);

        if (is_null($findCoupon) || $findCoupon->expiration_finish < $today || $findCoupon->expiration_start > $today) {
            return 406;
        }

        $findCouponAsiggned = CouponAssigned::where('coupon_id', $findCoupon->id)->where('user_id', $user_id)->first();

        if (!is_null($findCouponAsiggned)) {
            return 422;
        }

        $couponAssigned = CouponAssigned::create([
            'user_id' => $user_id,
            'coupon_id' => $findCoupon->id
        ]);

        if (!$couponAssigned) {
            Log::warning('No se agrego la asignacion del cupon ' . $findCoupon->id . ' con el usuario ' . $user_id);
            return 400;
        }

        return $this->assignedCoupon($shoppingCart_id, $findCoupon->id);
    }

    private function assignedCoupon($shoppingCart_id, $coupon_id)
    {
        try {
            $shopingCoupon = ShoppingCarts::find($shoppingCart_id);
            $shopingCoupon->coupon_id = $coupon_id;

            if (!$shopingCoupon->save()) {
                Log::warning('No se agrego el cupon ' . $coupon_id . ' al carrito ' . $shoppingCart_id);
                return 400;
            }

            return 201;
        } catch (\Exception $e) {
            Log::error('Error al ingresar el cupon ' . $e->getMessage());
        }
    }
}
