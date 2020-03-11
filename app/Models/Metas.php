<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metas extends Model
{
    protected $table = 'metas';

    protected $fillable = [
        'configuration_id',
        'keyword',
        'description'
    ];

    public function configuration()
    {
        return $this->belongsTo('App\Models\Configuration', 'configuration_id');
    }
}
