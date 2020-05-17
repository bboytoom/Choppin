<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'value',
        'status',
        'expiration_start',
        'expiration_finish'
    ];

    public function couponAssigned()
    {
        return $this->hasMany('App\Models\CouponAssigned', 'coupon_id');
    }
}
