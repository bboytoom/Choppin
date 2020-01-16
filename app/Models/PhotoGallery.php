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

    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery', 'gallery_id');
    }
}
