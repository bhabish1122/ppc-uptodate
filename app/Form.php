<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'form_type','name', 'description', 'phone', 'email','updated_by','sort_id','updated_by'
    ];
}
