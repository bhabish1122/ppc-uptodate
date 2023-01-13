<?php

namespace App\Http\Controllers\Web;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.download');
        $data_lists = Document::where('page', '6')
                            ->where('is_active', true)
                            ->orderBy('sort_id','ASC')
                            ->orderBy('created_at','DESC')
                            ->select('title','remark','image_enc','ext','created_at')
                            ->paginate(12);
        return view('web.download.index', compact(['notice_top','usefullinks','quickmenus','contacts','page_title','data_lists']));
    }
}
