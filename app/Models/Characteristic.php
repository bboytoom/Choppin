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
    protected $table = 'characteristic';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'producto_id',
        'characteristic',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
