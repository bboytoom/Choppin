<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoSlide extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photo_slides';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'configuration_id',
        'name',
        'image',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($slide) {
            $slide->name = e(strtolower($slide->name));
            $slide->description = e(strtolower($slide->description));
        });
    }

    public function configuration()
    {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
}
