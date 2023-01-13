<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\Background;
use App\Setting;
use App\Contact as ContactModel;
use App\Gallery;

class MainController extends Controller
{
    public function index(Request $request, $page1 = null, $page2 = null, $page3 = null, $page4 = null){
    	// page1 => always page name
    	// page1 => always page name || slug 
    	
    	// ------------- for all page -----------------
        // $usefullinks = $this->dwriCheck($request)['usefullink'];
        // $quickmenus = $this->dwriCheck($request)['quickmenu'];
        // $contacts = $this->dwriCheck($request)['contact'];
        // dd($quickmenus);
    	$usefullinks = UsefulLink::where('is_active', true)->orderBy('sort_id','DESC')->orderBy('created_at','DESC')->get();
    	$quickmenus = QuickMenu::where('is_active', true)->orderBy('sort_id','DESC')->orderBy('created_at','DESC')->get();
    	$contacts = Contact::where('is_active', true)->orderBy('sort_id','DESC')->orderBy('created_at','DESC')->get()->take('1');
    	// ------------- end for all page --------------
    	// dd($request, $page1, $page2, $page3,$page4);

    	if ($page4) {
    		# code...
	    	dd($page4);
    		
    	}

    	elseif ($page3) {
    		# code...
	    	dd($page3);
    	}

    	elseif ($page2) {
    		# code...
	    	// dd($page2);
            // dd('hello');
            try {
                $page = $page1 ."/". $page2;
                // dd($page);
                $setting_id = Setting::where('slug',$page)->value('id');
                // dd($setting_id);
                $setting_info = Setting::find($setting_id);
                // dd($setting_info,$page1);
                $model = "\\App\\".$setting_info->model_name;
                $data_query = $model::where('is_active', True);

                if($setting_info->slug == 'contact'){
                    $data_query->take(1);
                }

                $data_list = $data_query->orderBy('sort_id','ASC')
                                        ->orderBy('id','DESC')
                                        ->get();
                                        // dd($data_list);
            } catch (Throwable $e) {
                abort(404);

                return false;
            }
            dd($setting_info->route_name);
    	}

    	elseif ($page1) {
	    	// dd($setting_info->model_name."Model");
	    	// query
	    	try {
		    	$setting_id = Setting::where('slug',$page1)->value('id');
		    	$setting_info = Setting::find($setting_id);
                // dd($setting_info,$page1);
		    	$model = "\\App\\".$setting_info->model_name;
		    	$data_query = $model::where('is_active', True);

		    	if($setting_info->slug == 'contact'){
		    		$data_query->take(1);
		    	}

		    	$data_list = $data_query->orderBy('sort_id','ASC')
										->orderBy('id','DESC')
										->get();
		    } catch (Throwable $e) {
		        abort(404);

		        return false;
		    }

	    	// dd($data_list);
    	}

    	return view('web.'.$setting_info->route_name, compact('usefullinks','quickmenus','contacts','data_list'));
    }

}
