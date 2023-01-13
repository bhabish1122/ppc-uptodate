<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivisionSection extends Model
{
    protected $fillable = [
        'title',
        'office',
        'address',
        'contact_no',
        'email',
        'slug',
        'name',
        'designation',
        'image',
        'image_enc',
        'ext',
        'description',
        'division_work',
        'page',
        'created_by',
        'updated_by',
        'is_active',
        'sort_id',
        'created_at_np'
    ];
}
