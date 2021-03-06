<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoSlide extends Model
{
    protected $table = 'photo_slides';

    protected $fillable = [
        'configuration_id',
        'name',
        'image',
        'description',
        'status',
    ];

    public function configuration()
    {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
}
