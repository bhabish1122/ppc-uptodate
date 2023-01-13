<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    protected $fillable = [
    	'title','page', 'image', 'image_enc','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
