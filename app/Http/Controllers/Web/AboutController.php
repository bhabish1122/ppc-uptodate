<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\BackgroundSlider;
use App\Background;
use App\Mission;
use App\Vision;
use App\Objective;
use App\OrganizationalStructure;
use App\CorePerson;
use App\SectionDetail;

class AboutController extends Controller
{
    public function background()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $backgrounds_sliders = BackgroundSlider::where('is_active', true)
                                       ->orderBy('sort_id','ASC')
                                       ->orderBy('created_at','DESC')
                                       ->select('title','image_enc')
                                       ->take('6')
                                       ->get();
    	$backgrounds = Background::where('is_active', true)
                                ->orderBy('sort_id','ASC')
                                ->orderBy('created_at','DESC')
                                ->select('title','description')
                                ->get();
      return view('web.about.background.index',compact('notice_top','usefullinks','quickmenus','contacts','backgrounds','backgrounds_sliders'));
    }

    public function MissionVision()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$missions = Mission::where('is_active', true)
                         ->orderBy('sort_id','ASC')
                         ->orderBy('created_at','DESC')
                         ->select('description')
                         ->take('6')
                         ->get();
      $visions = Vision::where('is_active', true)
                       ->orderBy('sort_id','ASC')
                       ->orderBy('created_at','DESC')
                       ->select('description')
                       ->take('6')   
                       ->get();
      // only show if is_m_v true and to_date is null
      $core_persons = CorePerson::where('is_active', true)
                       ->where('is_m_v',true)
                       ->where('to_date',Null)
                       ->orderBy('is_top','DESC')
                       ->orderBy('sort_id','ASC')
                       ->select('name','designation','image_enc')
                       ->get();
      return view('web.about.missionvision.index',compact('notice_top','usefullinks','quickmenus','contacts','missions','visions','core_persons'));
    }

    public function objective()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$objectives = Objective::where('is_active', true)
                             ->orderBy('sort_id','ASC')
                             ->orderBy('created_at','DESC')
                             ->select('title','description')
                             ->get()
                             ->take('6');
      return view('web.about.objective.index',compact('notice_top','usefullinks','quickmenus','contacts','objectives'));
    }

    public function organizationStructure()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$organization_structures = OrganizationalStructure::where('is_active', true)
                                                       ->orderBy('sort_id','ASC')
                                                       ->orderBy('created_at','DESC')
                                                       ->select('title','image_enc')
                                                       ->where('type','0')
                                                       ->take('1')
                                                       ->get();
      return view('web.about.organization.index',compact('notice_top','usefullinks','quickmenus','contacts','organization_structures'));
    }

    public function ListOfDirectorGeneral()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$listofdirectors = CorePerson::where('is_active', true)
                                   ->where('is_employee','0')
                                   ->orderBy('sort_id','ASC')
                                   ->select('id','name','from_date','to_date','description','status','image_enc','designation')
                                   ->get();
      return view('web.about.list_of_director.index',compact('notice_top','usefullinks','quickmenus','contacts','listofdirectors'));
    }

    public function ListOfDirectorGeneralShow($id)
    {
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $data_list = CorePerson::select('name','from_date','to_date','description','status','image_enc','designation','phone','fax','email')
                                   ->find($id);
      return view('web.about.list_of_director.show',compact('notice_top','usefullinks','quickmenus','contacts','data_list'));
    }

    public function sectionDetail()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$sectiondetails = CorePerson::where('is_active', true)
                                     ->where('is_employee','1')
                                     ->orderBy('sort_id','ASC')
                                     // ->orderBy('created_at','DESC')
                                     ->get();
      return view('web.about.section_detail.index',compact('notice_top','usefullinks','quickmenus','contacts','sectiondetails'));
    }

    public function sachibalaya(Request $request){
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $sectiondetails = CorePerson::where('is_active', true)
                                   ->where('is_sachibalaya','1')
                                   ->orderBy('sort_id','ASC')
                                   ->paginate(20);
      return view('web.about.sachibalaya.index',compact('notice_top','usefullinks','quickmenus','contacts','sectiondetails'));
    }

    public function bill(Request $request){
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

    	$organization_structures = OrganizationalStructure::where('is_active', true)
                                                       ->orderBy('sort_id','ASC')
                                                       ->orderBy('created_at','DESC')
                                                       ->select('title','image_enc')
                                                       ->where('type','1')
                                                       ->take('1')
                                                       ->get();
      return view('web.about.organization.bill',compact('notice_top','usefullinks','quickmenus','contacts','organization_structures'));
    }
}
