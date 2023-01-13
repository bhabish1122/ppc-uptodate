<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportantForm extends Model
{
    protected $fillable = [
		'title','slug', 'image', 'image_enc','ext','remark','created_by','updated_by','is_active','sort_id','page','created_at_np'
	];
}
