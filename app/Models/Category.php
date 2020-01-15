<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\Categoryupdated;

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

    /**
    * The event map for the model.
    *
    * @var array
    */
    protected $dispatchesEvents = [
        'updated' => Categoryupdated::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            $category->name = e(strtolower($category->name));
            $category->slug = \Str::slug($category->name, '-');
            $category->description = e(strtolower($category->description));
        });
    }

    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery', 'category_id');
    }
}
