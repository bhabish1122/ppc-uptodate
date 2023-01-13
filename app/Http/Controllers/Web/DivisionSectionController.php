<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\DivisionSection;
use App\CorePerson;

class DivisionSectionController extends Controller
{
  public function index($page)
  {
    // for all page
    $notice_top = $this->allNotice(6)['notice'];
    $usefullinks = $this->allUsefulLink(5)['usefullink'];
    $quickmenus = $this->allQuickMenu(5)['quickmenu'];
    $contacts = $this->allContact(1)['contact'];

    if($page == 'planning_program_and_co_ordination_division'){
      $page_id = 1;
      $page_title = 'Planning Program & Co-ordination Division';
    }
    if($page == 'multipurpose_and_irrigation_division'){
      $page_id = 2;
      $page_title = 'Multipurpose & Irrigation Division';
    }
    if($page == 'water_induced_disaster_management_division'){
      $page_id = 3;
      $page_title = 'Water Induced Disaster Management Division';
    }
    if($page == 'ground_water_and_geological_division'){
      $page_id = 4;
      $page_title = 'Ground Water & Geological Division';
    }
    if($page == 'irrigation_management_division'){
      $page_id = 5;
      $page_title = 'Irrigation Management Division';
    }
    if($page == 'administration_section'){
      $page_id = 6;
      $page_title = 'Administration Section';
    }
    if($page == 'account_section'){
      $page_id = 7;
      $page_title = 'Account Section';
    }
    if($page == 'act_law_consultation_section'){
      $page_id = 8;
      $page_title = 'Act Law Consultation Section';
    }

    $data_list = DivisionSection::where('page', $page_id)
                                  ->where('is_active', true)
                                  ->orderBy('sort_id','ASC')
                                  ->orderBy('created_at','DESC')
                                  ->select('title','description','name','designation','image_enc','division_work')
                                  ->take(1)
                                  ->get();
    $core_persone_list = CorePerson::where('is_division_page', $page_id)
                                    ->where('is_active', true)
                                    ->orderBy('sort_id','ASC')
                                    ->select('name','designation','image_enc','phone','fax','email','slug','from_date','division')
                                    ->get();
                             // dd($data_list);
    return view('web.division-section.index',compact('notice_top','usefullinks','quickmenus','contacts','data_list','page_title','core_persone_list'));
  }
}