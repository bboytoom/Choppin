<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    protected $table = 'Unidades';
    protected $fillable = ['unidad', 'contraccion'];
}