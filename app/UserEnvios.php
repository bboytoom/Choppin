<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEnvios extends Model
{
    protected $table = 'users_envio';

    protected $fillable = [
        'user_id',
        'calle_uno', 
        'calle_dos', 
        'direccion', 
        'colonia', 
        'municipio', 
        'estado', 
        'pais', 
        'codigo_postal',
        'status'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
