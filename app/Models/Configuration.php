<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = [
        'user_id',
        'domain',
        'logo',
        'name',
        'business_name',
        'slogan',
        'email',
        'phone',
        'cost_shipping',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function photoconfiguration()
    {
        return $this->hasMany('App\Models\PhotoSlide', 'configuration_id');
    }

    public function metaconfiguration()
    {
        return $this->hasMany('App\Models\Metas', 'configuration_id');
    }
}
