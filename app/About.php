<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
	const LIMIT = 250;
    protected $fillable = [
        'title','slug','description','created_by','updated_by','is_active','sort_id','created_at_np'
    ];

 //    public function setTitleAttribute($value)
	// {
	//     $this->attributes['title'] = ucwords($value);
	// }

}
