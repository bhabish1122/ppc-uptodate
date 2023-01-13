<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title', 'image', 'image_enc','created_by','updated_by','is_active','created_at_np'
    ];
}
