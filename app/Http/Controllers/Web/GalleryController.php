<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\Gallery;
use App\GalleryHasImage;

class GalleryController extends Controller
{
    public function index()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$galleries = Gallery::where('is_active', true)
                          ->where('type','0')
                          ->orderBy('sort_id','ASC')
                          ->select('id','title','slug')
                          ->paginate('12');
                          // dd($galleries);
      return view('web.gallery.index',compact('notice_top','usefullinks','quickmenus','contacts','galleries'));
    }

    public function show($slug){
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $gallery_id = Gallery::where('slug', $slug)->value('id');
      $gallery_info = Gallery::find($gallery_id);
      $page_title = $gallery_info->title;
      // dd($page_title);

      $data_list = GalleryHasImage::where('gallery_id', $gallery_id)
                          ->where('is_active', true)
                          ->orderBy('sort_id','ASC')
                          ->select('title','image','image_enc','created_at')
                          ->paginate('20');
      return view('web.gallery.show',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title'));
    }
}
