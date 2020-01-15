<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\Productupdated;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'subcategory_id',
        'name',
        'slug',
        'extract',
        'description',
        'price',
        'status',
    ];

    /**
    * The event map for the model.
    *
    * @var array
    */
    protected $dispatchesEvents = [
        'updated' => Productupdated::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->name = e(strtolower($product->name));
            $product->slug = \Str::slug($product->name, '-');
            $product->extract = e(strtolower($product->extract));
            $product->description = e(strtolower($product->description));
            $product->price = e(strtolower($product->price));
        });
    }

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
}
