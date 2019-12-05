<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $table = 'productos_caracteristicas';
	protected $fillable = ['producto_id', 'caracteristica', 'descripcion'];
    public $timestamps = false;
    
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
}