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
        'admin_id',
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

    public function subcategory()
    {
        return $this->hasMany('App\Models\SubCategory', 'category_id');
    }
}
