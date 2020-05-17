<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\Coupon\CouponCollection;
use App\Models\Coupon;

class CouponController extends Controller
{
    private $pages = 10;

    public function index()
    {
        return new CouponCollection(Coupon::paginate($this->pages));
    }

    public function store(CouponRequest $request)
    {
        $coupon = Coupon::create([
            'name' => e(strtolower($request->name)),
            'value' =>  $request->value,
            'expiration_start' => $request->expiration_start,
            'expiration_finish' => $request->expiration_finish
        ]);

        if (!$coupon) {
            Log::warning('El cupon ' . $request->name . ' no se creo');
            return 400;
        }

        return response(null, 201);
    }

    public function show(Coupon $coupon)
    {
        CouponResource::withoutWrapping();
        return new CouponResource($coupon);
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon = Coupon::where('id', $coupon->id)->update([
            'name' => e(strtolower($request->name)),
            'value' =>  $request->value,
            'expiration_start' => $request->expiration_start,
            'expiration_finish' => $request->expiration_finish,
            'status' => $request->status
        ]);

        if (!$coupon) {
            Log::warning('El cupon ' . $request->name . ' no se actualizo correctamente');
            return 400;
        }

        return response(null, 200);
    }

    public function destroy(Coupon $coupon)
    {
        $coup = $coupon->delete();

        if (!$coup) {
            Log::warning('El cupon ' . $coupon->name . ' no se actualizo correctamente');
            return 400;
        }

        return response(null, 204);
    }
}
