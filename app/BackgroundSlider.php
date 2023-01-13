<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackgroundSlider extends Model
{
    protected $fillable = [
	    'title', 'image', 'image_enc','created_by','updated_by','is_active','sort_id','created_at_np'
    ];

    public function setTitleAttribute($value)
	{
	    $this->attributes['title'] = ucwords($value);
	}
}
