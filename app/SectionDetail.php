<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionDetail extends Model
{
    protected $fillable = [
	    'title', 
	    'image', 
	    'image_enc',
	    'designation',
	    'department',
	    'contact_no',
	    'email',
	    'created_by',
	    'updated_by',
	    'is_active',
	    'sort_id',
	    'created_at_np'
    ];
}
