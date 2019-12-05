<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

	protected $fillable = ['subtotal', 'shipping', 'user_id'];

	public function user()
	{
	    return $this->belongsTo('App\Models\User');
	}

	public function order_items()
	{
	    return $this->hasMany('App\Models\OrderItem');
	}
}