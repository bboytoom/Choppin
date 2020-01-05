<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shippings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'street_one',
        'street_two',
        'addres',
        'suburb',
        'town',
        'state',
        'country',
        'postal_code',
        'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($shipping) {
            $shipping->street_one = e(strtolower($shipping->street_one));
            $shipping->street_two = e(strtolower($shipping->street_two));
            $shipping->addres = e(strtolower($shipping->addres));
            $shipping->suburb = e(strtolower($shipping->suburb));
            $shipping->town = e(strtolower($shipping->town));
            $shipping->state = e(strtolower($shipping->state));
            $shipping->country = e(strtolower($shipping->country));
            $shipping->postal_code = e(strtolower($shipping->postal_code));
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
