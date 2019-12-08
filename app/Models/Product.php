<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name', 
        'slug', 
        'extract',
        'description', 
        'price', 
        'image', 
        'status',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function characteristic()
    {
        return $this->hasMany('App\Models\Characteristic');
    }
}
