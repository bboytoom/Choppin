<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

	protected $fillable = ['name', 'slug', 'description', 'extract', 'image', 'visible', 'price', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function order_item()
    {
        return $this->hasOne('App\Models\OrderItem');
    }
}