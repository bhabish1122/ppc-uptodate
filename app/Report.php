<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = [
		'title','slug', 'image', 'image_enc', 'ext','description','created_by','updated_by','is_active','sort_id','page','created_at_np'
	];
}
