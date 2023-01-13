<?php

namespace App\Http\Controllers\Web;

use App\CitizenCharter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NagarikWodapatraController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.nagarik_wodapatra');
        $data_lists = CitizenCharter::where('is_active', true)
                                    ->orderBy('sort_id','ASC')
                                    ->orderBy('created_at','DESC')
                                    ->select('title', 'image_enc','created_at')
                                    ->paginate(12);
        return view('web.nagarik_wodapatra.index', compact(['notice_top','usefullinks','quickmenus','contacts','page_title','data_lists']));
    }
}
