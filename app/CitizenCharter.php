<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitizenCharter extends Model
{
    protected $fillable = [
        'title','slug','description','image','image_enc','ext','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
