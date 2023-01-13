<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = [
        'description','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
