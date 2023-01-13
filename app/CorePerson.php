<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorePerson extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'designation',
        'name_en',
        'designation_en',
        'department',
        'facebook',
        'twitter',
        'youtube',
        'image',
        'image_enc',
        'division',
        'phone',
        'fax',
        'email',
        'description',
        'created_by',
        'updated_by',
        'is_active',
        'sort_id',
        'status',
        'is_division_page',
        // 'is_top',
        // 'is_start',
        'is_m_v',
        'from_date',
        'to_date',
        'from_date_np',
        'to_date_np',
        'created_at_np',
        // 'is_slider',
        'is_front',
        'is_employee',
        'is_sachibalaya',
    ];

 //    public function setNameAttribute($value)
	// {
	//     $this->attributes['name'] = ucwords($value);
	// }
}
