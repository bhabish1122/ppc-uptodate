<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\Report;

class ReportController extends Controller
{
    public function index($page)
	{
		// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		if($page == 'pre-feasibility'){
			$page_id = 4;
			$page_title = __('lang.pre_feasibility');
		}
		if($page == 'feasibility'){
			$page_id = 5;
			$page_title = __('lang.feasibility');
		}
		if($page == 'detail-feasibility'){
			$page_id = 3;
			$page_title = __('lang.detail_feasibility');
		}
		if($page == 'quaterly-report'){
			$page_id = 1;
			$page_title = __('lang.quaterly_report');
		}
		if($page == 'yearly-report'){
			$page_id = 2;
			$page_title = __('lang.yearly_report');
		}
		if($page == 'monthly-report'){
			$page_id = 6;
			$page_title = __('lang.monthly-report');
		}
		if($page == 'semi-annual-report'){
			$page_id = 7;
			$page_title = __('lang.semi_report');
		}
		if($page == 'jinsi'){
			$page_id = 8;
			$page_title = __('lang.jinsi');
		}
		if($page == 'suchanako'){
			$page_id = 9;
			$page_title = __('lang.suchanako');
		}
		if($page == 'budget'){
			$page_id = 10;
			$page_title = __('lang.budget');
		}
		if($page == 'karya'){
			$page_id = 11;
			$page_title = __('lang.karya');
		}
		if($page == 'lekha'){
			$page_id = 12;
			$page_title = __('lang.lekha');
		}
		if($page == 'aantarik'){
			$page_id = 13;
			$page_title = __('lang.aantarik');
		}
		if($page == 'ek'){
			$page_id = 14;
			$page_title = __('lang.ek');
		}
		
		$data_list = Report::where('page', $page_id)
							->where('is_active', true)
							->orderBy('sort_id','ASC')
							->orderBy('created_at','DESC')
							->select('title','slug','description','image_enc','created_at','updated_at')
							->paginate(10);
		// dd($data_list);
		return view('web.report.index',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title','page'));
	}

	public function show($page , $slug)
	{
		// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		if($page == 'pre-feasibility'){
			$page_id = 4;
			$page_title = __('lang.pre_feasibility');
		}
		if($page == 'feasibility'){
			$page_id = 5;
			$page_title = __('lang.feasibility');
		}
		if($page == 'detail-feasibility'){
			$page_id = 3;
			$page_title = __('lang.detail_feasibility');
		}
		if($page == 'quaterly-report'){
			$page_id = 1;
			$page_title = __('lang.quaterly_report');
		}
		if($page == 'yearly-report'){
			$page_id = 2;
			$page_title = __('lang.yearly_report');
		}
		if($page == 'monthly-report'){
			$page_id = 6;
			$page_title = __('lang.monthly-report');
		}
		if($page == 'semi-annual-report'){
			$page_id = 7;
			$page_title = __('lang.semi_report');
		}
		if($page == 'jinsi'){
			$page_id = 8;
			$page_title = __('lang.jinsi');
		}
		if($page == 'suchanako'){
			$page_id = 9;
			$page_title = __('lang.suchanako');
		}
		if($page == 'budget'){
			$page_id = 10;
			$page_title = __('lang.budget');
		}
		if($page == 'karya'){
			$page_id = 11;
			$page_title = __('lang.karya');
		}
		if($page == 'lekha'){
			$page_id = 12;
			$page_title = __('lang.lekha');
		}
		if($page == 'aantarik'){
			$page_id = 13;
			$page_title = __('lang.aantarik');
		}
		if($page == 'ek'){
			$page_id = 14;
			$page_title = __('lang.ek');
		}
		$data_find = Report::where('page', $page_id)
							->where('slug', $slug)
							->where('is_active', true)
							->orderBy('sort_id','ASC')
							->orderBy('created_at','DESC')
							->select('title','slug','description','image_enc','created_at','updated_at');
							
		$sub_title = $data_find->value('title');
		$data_list = $data_find->take(1)->get();
		// dd($data_list);
		return view('web.report.show',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title','page','sub_title'));
	}

	public function indexAll()
	{
		// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		$data_list = Report::where('is_active', true)
							->orderBy('sort_id','ASC')
							->orderBy('created_at','DESC')
							->select('title','slug','description','image_enc','created_at','updated_at','page')
							->paginate(10);
							$page = 'detail-design';
		// dd($data_list);
		return view('web.report.all',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page'));
	}
}