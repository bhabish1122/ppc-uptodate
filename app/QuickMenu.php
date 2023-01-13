<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuickMenu extends Model
{
    protected $fillable = [
        'title', 'title_en','link','created_by','updated_by','is_active','sort_id','created_at_np'
    ];

    public function setTitleAttribute($value)
	{
	    $this->attributes['title'] = ucwords($value);
	}
}
