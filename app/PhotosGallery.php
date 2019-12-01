<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotosGallery extends Model
{
    protected $table = 'photo_gallery';
	protected $fillable = ['title', 'image', 'description', 'status'];
    public $timestamps = false;
}
