<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table = 'productos_caracteristicas';
	protected $fillable = ['producto_id', 'caracteristica', 'descripcion'];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}