<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Events\Userupdated;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

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
        'created_at',
        'updated_at'
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

    /**
    * The event map for the model.
    *
    * @var array
    */
    protected $dispatchesEvents = [
        'updated' => Userupdated::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->name = e(strtolower($user->name));
            $user->mother_surname = e(strtolower($user->mother_surname));
            $user->father_surname = e(strtolower($user->father_surname));
            $user->email = e(strtolower($user->email));
            $user->password = \Hash::make('@User2907');
        });

        static::updating(function ($user) {
            $user->name = e(strtolower($user->name));
            $user->mother_surname = e(strtolower($user->mother_surname));
            $user->father_surname = e(strtolower($user->father_surname));
            $user->email = e(strtolower($user->email));
        });
    }

    public function shipping()
    {
        return $this->hasMany('App\Models\Shipping', 'user_id');
    }
}
