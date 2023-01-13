<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\ListOfProject;

class ListOfProjectController extends Controller
{
  public function index()
  {
  	// for all page
    $notice_top = $this->allNotice(6)['notice'];
    $usefullinks = $this->allUsefulLink(5)['usefullink'];
    $quickmenus = $this->allQuickMenu(5)['quickmenu'];
    $contacts = $this->allContact(1)['contact'];

  	$list_of_projects = ListOfProject::where('is_active', true)
                                         ->orderBy('sort_id','ASC')
                                         ->select('title','title_np','description','link','slug')
                                         ->get();
                                         // dd($list_of_projects);
    return view('web.list_of_project.index',compact('notice_top','usefullinks','quickmenus','contacts','list_of_projects'));
  }

  public function show($slug) {
    // for all page
    $notice_top = $this->allNotice(6)['notice'];
    $usefullinks = $this->allUsefulLink(5)['usefullink'];
    $quickmenus = $this->allQuickMenu(5)['quickmenu'];
    $contacts = $this->allContact(1)['contact'];

    $list_of_projects = ListOfProject::where('slug', $slug)
                                     ->where('is_active', true)
                                     ->orderBy('sort_id','ASC')
                                     ->select('title','title_np','description','link','slug')
                                     ->get();
    $sub_title = $list_of_projects[0]->title;
    return view('web.list_of_project.show',compact('notice_top','usefullinks','quickmenus','contacts','list_of_projects','sub_title'));
  }
}
