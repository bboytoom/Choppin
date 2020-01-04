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
        'admin_id',
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

    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subcategory_id');
    }

    public function characteristic()
    {
        return $this->hasMany('App\Models\Characteristic', 'product_id');
    }
}
