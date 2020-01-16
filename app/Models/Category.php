<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery', 'category_id');
    }
}
