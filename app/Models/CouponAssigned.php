<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponAssigned extends Model
{
    protected $table = 'coupon_assigneds';

    protected $fillable = [
        'user_id',
        'coupon_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'coupon_id');
    }
}
