<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';

    protected $fillable = [
        'user_id',
        'name',
        'street_one',
        'street_two',
        'addres',
        'suburb',
        'town',
        'state',
        'country_code',
        'postal_code',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Orders', 'shipping_address_id');
    }
}
