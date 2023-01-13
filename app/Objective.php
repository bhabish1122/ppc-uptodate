<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    protected $fillable = [
        'title','description','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
