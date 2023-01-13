<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;

use App\Background;
use App\Mission;
use App\Vision;
use App\Objective;
use App\OrganizationalStructure;
use App\SectionDetail;

class ContactController extends Controller
{
    public function index()
    {
    	// for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

        return view('web.contact.index',compact('notice_top','usefullinks','quickmenus','contacts'));
    }
}
