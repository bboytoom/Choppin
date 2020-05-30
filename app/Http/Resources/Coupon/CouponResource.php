<?php

namespace App\Http\Resources\Coupon;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'type' => $this->getTable(),
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'value' => $this->value,
                'type' => $this->type,
                'status' => $this->status,
                'expiration_start' =>  $this->expiration_start,
                'expiration_finish' =>  $this->expiration_finish
            ]
        ];
    }
}
