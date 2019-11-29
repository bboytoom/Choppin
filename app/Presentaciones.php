<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentaciones extends Model
{
    protected $table = 'presentaciones';
    protected $fillable = ['presentacion', 'contraccion'];
}