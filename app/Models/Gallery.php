<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\Galleryupdated;

class Gallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'active',
        'status',
    ];

    /**
    * The event map for the model.
    *
    * @var array
    */
    protected $dispatchesEvents = [
        'updated' => Galleryupdated::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($gallery) {
            $gallery->name = e(strtolower($gallery->name));
        });
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
