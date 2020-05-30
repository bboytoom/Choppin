<?php

namespace App\Http\Controllers\API\Store;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoppingCarts;
use App\Models\InShoppingCart;
use App\Models\Coupon;
use App\Models\CouponAssigned;

class IndexController extends Controller
{
    private $pages = 10;

    public function __construct()
    {
        $this->middleware('shoppingcart')->only('store');
    }

    public function store(Request $request)
    {
        $shoppingcart = $request->shopping_cart;

        try {
            foreach ($request->cart as $products) {
                $inshop = InShoppingCart::create([
                    'shopping_cart_id' => $shoppingcart->id,
                    'product_id' => $products['id'],
                    'qty' => $products['qty']
                ]);

                if (!$inshop) {
                    Log::warning('No se guardo la compra del producto ' . $products['id'] . ' ' . $shoppingcart->id);
                    return response(null, 400);
                }
            }

            if (!is_null($request->coupon)) {
                $this->addCoupon($request->coupon, $shoppingcart->id);
            }

            return response(null, 200);
        } catch (\Exception $e) {
            Log::error('Error al generar la compra del siguiente producto ' . $products['id'] . ' ' . $shoppingcart->id . ', ya que muestra la siguiente Exception ' . $e->getMessage());
        }
    }

    private function addCoupon($coupon, $shoppingCart_id)
    {
        $user_id = Auth::id();
        $today = today();

        $findCoupon = Coupon::firstWhere('name', $coupon);

        if (is_null($findCoupon) || $findCoupon->expiration_finish < $today || $findCoupon->expiration_start > $today) {
            return response(null, 422);
        }

        $couponAssigned = CouponAssigned::create([
            'user_id' => $user_id,
            'coupon_id' => $findCoupon->id
        ]);

        if (!$couponAssigned) {
            Log::warning('No se agrego la asignacion del cupon ' . $findCoupon->id . ' con el usuario ' . $user_id);
            return response(null, 400);
        }

        try {
            $shopingCoupon = ShoppingCarts::find($shoppingCart_id);
            $shopingCoupon->coupon_id = $findCoupon->id;

            if (!$shopingCoupon->save()) {
                Log::warning('No se agrego el cupon ' . $findCoupon->id . ' al carrito ' . $shoppingCart_id);
                return response(null, 400);
            }
        } catch (\Exception $e) {
            Log::error('Error al ingresar el cupon ' . $e->getMessage());
        }
    }
}
