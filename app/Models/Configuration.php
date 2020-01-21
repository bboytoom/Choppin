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
        'name',
        'business_name',
        'slogan',
        'email',
        'phone',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($configuration) {
            $configuration->domain = e(strtolower($configuration->domain));
            $configuration->name = e(strtolower($configuration->name));
            $configuration->business_name = e(strtolower($configuration->business_name));
            $configuration->slogan = e(strtolower($configuration->slogan));
            $configuration->email = e(strtolower($configuration->email));
            $configuration->phone = e(strtolower($configuration->phone));
        });
    }

    public function photoconfiguration()
    {
        return $this->hasMany('App\Models\PhotoSlide', 'configuration_id');
    }
}
