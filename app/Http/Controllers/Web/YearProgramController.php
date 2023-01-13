<?php

namespace App\Http\Controllers\Web;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YearProgramController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.year_program_budget');
        $data_lists = Document::where('page', '7')
                            ->where('is_active', true)
                            ->orderBy('sort_id','ASC')
                            ->orderBy('created_at','DESC')
                            ->select('title','remark','image_enc','ext','created_at')
                            ->paginate(12);
        return view('web.year_program_budget.index', compact(['notice_top','usefullinks','quickmenus','contacts','page_title','data_lists']));
    }
}