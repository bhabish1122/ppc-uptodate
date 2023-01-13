<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = [
        'description','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
