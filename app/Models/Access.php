<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';

    protected $fillable = [
        'user_id',
        'operating_system',
        'browser'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
