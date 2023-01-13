<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Notice;
use App\Document;
use App\Report;

class SearchController extends Controller
{
    public function search(Request $request){
    	// dd($request);
    	// for all page
    	$notice_top = $this->allNotice(6)['notice'];
    	$usefullinks = $this->allUsefulLink(5)['usefullink'];
    	$quickmenus = $this->allQuickMenu(3)['quickmenu'];
    	$contacts = $this->allContact(1)['contact'];

    	$search_title = $request->title;
        $selected = $request->selected;

        if ($request->selected == 1 || $request->selected == 0) {
            $search_selected = 'notice';
        	$search_list = Notice::where('is_active', true);
            if ($search_title != '') {
				$search_list->where('title', 'LIKE',"%{$search_title}%");
            }
            $search_result = $search_list->orderBy('sort_id','ASC')
                                         ->orderBy('created_at','DESC')
                                         ->select('title','page','slug','date','created_at','image_enc')
                                         ->paginate(10);
        }
        if ($request->selected == 2) {
            $search_selected = 'document';
            $search_list = Document::where('is_active', true);
            if ($search_title != '') {
                $search_list->where('title', 'LIKE',"%{$search_title}%");
            }
            $search_result = $search_list->orderBy('sort_id','ASC')
                                         ->orderBy('created_at','DESC')
                                         ->select('title','page','slug','created_at','image_enc')
                                         ->paginate(10);
        }
        if ($request->selected == 3) {
            $search_selected = 'report';
            $search_list = Report::where('is_active', true);
            if ($search_title != '') {
                $search_list->where('title', 'LIKE',"%{$search_title}%");
            }
            $search_result = $search_list->orderBy('sort_id','ASC')
                                         ->orderBy('created_at','DESC')
                                         ->select('title','page','slug','created_at','image_enc')
                                         ->paginate(10);
        }

    	return view('web.search.index', compact(['notice_top','usefullinks','quickmenus','contacts','search_result','search_title','selected','search_selected']));
    }
}
