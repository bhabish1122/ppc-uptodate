<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryHasImage extends Model
{
    protected $fillable = [
	    'gallery_id','title','description', 'image', 'image_enc','created_by','updated_by','is_active','sort_id','created_at_np'
    ];
}
