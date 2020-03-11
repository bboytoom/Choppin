<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'subcategory_id');
    }
}
