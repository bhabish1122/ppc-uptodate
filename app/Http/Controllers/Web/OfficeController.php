<?php

namespace App\Http\Controllers\Web;

use App\CorePerson;
use App\DivisionSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.office');
        $data_lists = DivisionSection::where('is_active', true)
                                    ->orderBy('sort_id','ASC')
                                    ->orderBy('created_at','DESC')
                                    ->get();
        return view('web.about.office.index', compact(['notice_top','usefullinks','quickmenus','contacts','page_title','data_lists']));
    }

    public function show($id)
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.office');
        $page_id = 1;

        $data_lists = DivisionSection::where('id', $id)
                                    ->where('is_active', true)
                                    ->orderBy('sort_id','ASC')
                                    ->orderBy('created_at','DESC')
                                    ->take(1)
                                    ->get();
        $core_persone_list = CorePerson::where('is_division_page', $page_id)
                                      ->where('is_active', true)
                                      ->orderBy('sort_id','ASC')
                                      ->select('name','designation','image_enc','phone','fax','email','slug','from_date','division')
                                      ->get();
        return view('web.about.office.show', compact(['notice_top','usefullinks','quickmenus','contacts','page_title','data_lists','core_persone_list']));
    }
}
