<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\SubCategoryupdated;

class SubCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sub_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'category_id',
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
        'updated' => SubCategoryupdated::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($subcategory) {
            $subcategory->name = e(strtolower($subcategory->name));
            $subcategory->slug = \Str::slug($subcategory->name, '-');
            $subcategory->description = e(strtolower($subcategory->description));
        });
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'subcategory_id');
    }
}
