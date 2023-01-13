<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Config;

class Config extends Model
{
    protected $fillable = [
        'title',
        'office',
        'address',
        'title_np',
        'office_np',
        'address_np', 
        'image', 
        'image_enc',
        'created_by',
        'updated_by',
        'is_active',
        'created_at_np'
    ];

    public static function getConfig(Request $request){
        $setting_id = Config::orderBy('id', 'DESC')->take(1)->value('id');
        return Config::find($setting_id);
    }
}
