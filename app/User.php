<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'permission_id',
        'type',
        'name',
        'email',
        'password',
        'father_surname',
        'mother_surname',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function configuration()
    {
        return $this->hasMany('App\Models\Configuration', 'user_id');
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping', 'user_id');
    }

    public function permission()
    {
        return $this->belongsTo('App\Models\Permission', 'permission_id');
    }

    public function Access(string $access)
    {
        $arrayAccess = json_decode($this->permission->permission);
        
        foreach ($arrayAccess as $key) {
            if ($key == $access) {
                return true;
            }
        }

        return false;
    }
}
