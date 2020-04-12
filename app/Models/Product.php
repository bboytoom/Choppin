<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PayPal\Api\Item;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'subcategory_id',
        'name',
        'slug',
        'extract',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function image()
    {
        return $this->hasMany('App\Models\Photo', 'product_id');
    }

    public function characteristic()
    {
        return $this->hasMany('App\Models\Characteristic', 'product_id');
    }

    public function quantity()
    {
        return $this->hasMany('App\Models\InShoppingCart', 'product_id');
    }

    public function paypalItem($quantity)
    {
        $item = new Item();
        $paypal_conf = \Config::get('Paypal');
       
        return $item->setName($this->name)
            ->setDescription($this->extract)
            ->setPrice($this->price)
            ->setQuantity($quantity->qty)
            ->setCurrency($paypal_conf['currency']);
    }
}
