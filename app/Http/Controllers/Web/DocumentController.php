<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsefulLink;
use App\QuickMenu;
use App\Contact;
use App\Document;

class DocumentController extends Controller
{
	public function index($page)
	{
		// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		if($page == 'act'){
			$page_id = 1;
			$page_title = __('lang.act');
		}
		if($page == 'regulation'){
			$page_id = 2;
			$page_title = __('lang.regulation');
		}
		if($page == 'act_rule'){
			$page_id = 3;
			$page_title = __('lang.act_rule');
		}
		if($page == 'nirdeshika'){
			$page_id = 4;
			$page_title = __('lang.nirdeshika');
		}
		if($page == 'other'){
			$page_id = 5;
			$page_title = __('lang.other');
		}
		if($page == 'download'){
			$page_id = 6;
			$page_title = __('lang.download');
		}
		if($page == 'year_program_budget'){
			$page_id = 7;
			$page_title = __('lang.year_program_budget');
		}
		if($page == 'red-book'){
			$page_id = 8;
			$page_title = __('lang.red-book');
		}
		if($page == 'bid'){
			$page_id = 9;
			$page_title = __('lang.bid');
		}
		if($page == 'reportrighttoinfo'){
			$page_id = 11;
			$page_title = __('lang.reportrighttoinfo');
		}
		if($page == 'economicsurvey'){
			$page_id = 10;
			$page_title = __('lang.economicsurvey');
		}
		if($page == 'mediumexpenditure'){
			$page_id = 12;
			$page_title = __('lang.mediumexpenditure');
		}
		$data_list = Document::where('page', $page_id)
							->where('is_active', true)
							->orderBy('sort_id','ASC')
							->orderBy('created_at','DESC')
							->select('title','remark','image_enc','ext')
							->paginate(10);
		// dd($data_list);
		return view('web.document.index',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title'));
		
    }

    public function show($page , $slug){
    	// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		if($page == 'act'){
			$page_id = 1;
			$page_title = __('lang.act');
		}
		if($page == 'regulation'){
			$page_id = 2;
			$page_title = __('lang.regulation');
		}
		if($page == 'act_rule'){
			$page_id = 3;
			$page_title = __('lang.act_rule');
		}
		if($page == 'nirdeshika'){
			$page_id = 4;
			$page_title = __('lang.nirdeshika');
		}
		if($page == 'other'){
			$page_id = 5;
			$page_title = __('lang.other');
		}
		if($page == 'download'){
			$page_id = 6;
			$page_title = __('lang.download');
		}
		if($page == 'year_program_budget'){
			$page_id = 7;
			$page_title = __('lang.year_program_budget');
		}

		$data_list = Document::where('page', $page_id)
							->where('is_active', true)
							->where('slug',$slug)
							->get();
		// dd($data_list);
		return view('web.document.show',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title'));
    }
}