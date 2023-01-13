<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
    	'title', 
    	'slug',
    	'type',
    	'link',
    	'created_by',
    	'updated_by',
    	'is_active',
    	'sort_id',
    	'created_at_np'
    ];

    public function galleryImage()
	{
		return $this->hasMany('App\GalleryHasImage','gallery_id','id');
	}
}
