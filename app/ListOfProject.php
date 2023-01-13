<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListOfProject extends Model
{
    protected $fillable = [
        'title','title_np','slug','description','link','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
