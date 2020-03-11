<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }
}
