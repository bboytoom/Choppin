<?php

namespace App\Http\Resources\Coupon;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CouponCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => CouponResource::collection($this->collection)
        ];
    }
}
