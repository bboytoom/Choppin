<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'admin';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'father_surname',
        'mother_surname',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($admin) {
            $admin->name = e(strtolower($admin->name));
            $admin->mother_surname = e(strtolower($admin->mother_surname));
            $admin->father_surname = e(strtolower($admin->father_surname));
            $admin->email = e(strtolower($admin->email));
            $admin->password = \Hash::make('@Admin2907');
        });

        static::updating(function ($admin) {
            $admin->name = e(strtolower($admin->name));
            $admin->mother_surname = e(strtolower($admin->mother_surname));
            $admin->father_surname = e(strtolower($admin->father_surname));
            $admin->email = e(strtolower($admin->email));
        });
    }
}
