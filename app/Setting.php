<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
    	'slug','model_name','page_name','edit_page_name','detail_page_name','pagination','path','is_active'
    ];

    public function setPageNameAttribute($value)
	{
	    $this->attributes['page_name'] = ucwords($value);
	}
}
