<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'name',
        'image',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($photo) {
            $photo->name = e(strtolower($photo->name));
            $photo->description = e(strtolower($photo->description));
        });
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
