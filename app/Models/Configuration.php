<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'configurations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'domain',
        'logo',
        'name',
        'business_name',
        'slogan',
        'email',
        'phone',
        'status'
    ];

    public function photoconfiguration()
    {
        return $this->hasMany('App\Models\PhotoSlide', 'configuration_id');
    }
}
