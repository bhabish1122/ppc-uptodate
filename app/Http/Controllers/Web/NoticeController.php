<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\Notice;

class NoticeController extends Controller
{
    public function index($page)
	{
		// for all page
		$notice_top = $this->allNotice(6)['notice'];
		$usefullinks = $this->allUsefulLink(5)['usefullink'];
		$quickmenus = $this->allQuickMenu(5)['quickmenu'];
		$contacts = $this->allContact(1)['contact'];

		$data_all = Notice::where('is_active', true);

		if($page == 'general-notice'){
			$page_id = 1;
			$page_title = __('lang.general_notice');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark','created_at');
		}
		if($page == 'procurement-notice'){
			$page_id = 2;
			$page_title = __('lang.procurement_notice');
			$return_to = 'procurement_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','image_enc','ext','date','remark','description','page','contract_id','is_top','status');
		}
		if($page == 'posting-notice'){
			$page_id = 3;
			$page_title = __('lang.posting_notice');
			$return_to = 'posting_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','remark','description','page','contract_id','is_top','status');
		}
		if($page == 'publication'){
			$page_id = 4;
			$page_title = __('lang.publication');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}
		if($page == 'circular'){
			$page_id = 5;
			$page_title = __('lang.circular');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}
		if($page == 'bulletine-notice-board'){
			$page_id = 6;
			$page_title = __('lang.bulletin_notice_board');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}

		$data_list = $data_all->orderBy('sort_id','ASC')
							  ->orderBy('created_at','DESC')
							  ->paginate(10);
		// dd($data_list);
		return view('web.notice.'.$return_to.'.index',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title','page'));
    }

    public function show($page , $slug){
    	// for all page
    	$notice_top = $this->allNotice(6)['notice'];
    	$usefullinks = $this->allUsefulLink(5)['usefullink'];
    	$quickmenus = $this->allQuickMenu(5)['quickmenu'];
    	$contacts = $this->allContact(1)['contact'];

		$data_all = Notice::where('is_active', true)->where('slug', $slug);

		if($page == 'general-notice'){
			$page_id = 1;
			$page_title = __('lang.general_notice');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark','created_at');
		}
		if($page == 'procurement-notice'){
			$page_id = 2;
			$page_title = __('lang.procurement_notice');
			$return_to = 'procurement_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','image_enc','ext','date','remark','description','page','contract_id','is_top','status');
		}
		if($page == 'posting-notice'){
			$page_id = 3;
			$page_title = __('lang.posting_notice');
			$return_to = 'posting_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','remark','description','page','contract_id','is_top','status');
		}
		if($page == 'publication'){
			$page_id = 4;
			$page_title = __('lang.publication');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}
		if($page == 'circular'){
			$page_id = 5;
			$page_title = __('lang.circular');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}
		if($page == 'bulletine-notice-board'){
			$page_id = 6;
			$page_title = __('lang.bulletin_notice_board');
			$return_to = 'general_notice';
			$data_all = $data_all->where('page',$page_id)
								 ->select('title','slug','image_enc','ext','date','description','remark');
		}

		if($page == 'recent-notice'){
			$page_id = 6;
			$page_title = __('lang.recent_notice');
			$return_to = 'general_notice';
			$data_all = $data_all->select('title','slug','image_enc','ext','date','remark','description','page','contract_id','is_top','status');
		}

		$sub_title = $data_all->take(1)->value('title');

		$data_list = $data_all->orderBy('sort_id','ASC')
							  ->orderBy('created_at','DESC')
							  ->take(1)
							  ->get();
		// dd($data_list);
		return view('web.notice.'.$return_to.'.show',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title','page','sub_title'));
    }
}