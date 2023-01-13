<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'address','phone','address_en','phone_en','email','facebook','twitter','googleplus','youtube','map','created_by','updated_by','is_active','sort_id','created_at_np','facebook_embeded','twitter_embeded',
    ];
}
