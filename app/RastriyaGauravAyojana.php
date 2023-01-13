<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RastriyaGauravAyojana extends Model
{
    protected $fillable = [
        'title','slug','description','link','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
