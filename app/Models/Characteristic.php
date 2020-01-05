<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'characteristics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'product_id',
        'name',
        'description',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($characteristic) {
            $characteristic->name = e(strtolower($characteristic->name));
            $characteristic->description = e(strtolower($characteristic->description));
        });
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
