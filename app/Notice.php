<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notice extends Model
{
	const LIMIT = 50;
    protected $fillable = [
	    'title','slug', 'image', 'image_enc', 'ext','date','date_np','remark','description','page','contract_id','is_top','is_pop','duration','status','created_by','updated_by','is_active','sort_id','created_at_np'
    ];

    public function limit()
    {
        return Str::limit($this->description, Notice::LIMIT );
    }
}
