<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photo_galleries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gallery_id',
        'name',
        'image',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($photosgallery) {
            $photosgallery->name = e(strtolower($photosgallery->name));
            $photosgallery->description = e(strtolower($photosgallery->description));
        });
    }
}
