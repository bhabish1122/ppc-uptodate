<?php

namespace App\Http\Controllers\Web;

use App\Gallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryVideoController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.video_gallery');
        $data_lists = Gallery::where('is_active', true)
                          ->where('type','1')
                          ->orderBy('sort_id','ASC')
                          ->orderBy('id','DESC')
                          ->paginate('12');
                          // dd($data_lists);
      return view('web.gallery.video.index',compact('notice_top','usefullinks','quickmenus','contacts','data_lists','page_title'));
    }
}
