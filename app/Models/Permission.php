<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    
    protected $fillable = [
        'name',
        'permission'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'permission_id');
    }
}
