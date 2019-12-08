<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shipping';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'street_one', 
        'street_two', 
        'addres', 
        'suburb', 
        'town', 
        'state', 
        'country', 
        'postal_code',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
