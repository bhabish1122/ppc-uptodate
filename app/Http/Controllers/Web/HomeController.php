<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use App\Slider;
use App\About;
use App\Notice;
use App\DivisionSection;
use App\Document;
use App\CitizenCharter;
use App\RastriyaGauravAyojana;
use App\CorePerson;
use App\GalleryHasImage;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
      $sliders = Slider::where('is_active', true)
                       ->orderBy('sort_id','ASC')
                       ->orderBy('created_at','DESC')
                       ->select('title','image_enc')
                       ->get();
      $mantri = CorePerson::where('is_active', true)
                                 ->where('is_front', '1')
                                 ->orderBy('sort_id','ASC')
                                 ->orderBy('created_at','DESC')
                                 ->select('name','designation','name_en','designation_en','image_enc','id','facebook','twitter','youtube')
                                 ->latest()
                                 ->first();
      $sachib = CorePerson::where('is_active', true)
                                 ->where('is_front', '2')
                                 // ->where('to_date', Null)
                                 ->orderBy('sort_id','ASC')
                                 ->orderBy('created_at','DESC')
                                 ->select('name','designation','name_en','designation_en','image_enc','id','facebook','twitter','youtube')
                                 ->latest()
                                 ->first();
      $prabakta_suchana_adhikari = CorePerson::where('is_active', true)
                                  ->where(function($query) {
                                      return $query
                                          ->where('is_front', '3')
                                          ->orWhere('is_front','4')
                                          ->orWhere('is_front','5');
                                  })                                 
                                 // ->where('to_date', Null)
                                 ->orderBy('sort_id','ASC')
                                 ->orderBy('created_at','DESC')
                                 ->select('name','designation','name_en','designation_en','image_enc','id','facebook','twitter','youtube','description','phone')
                                 ->get();
      $abouts = About::where('is_active', true)
                     ->orderBy('sort_id','ASC')
                     ->orderBy('created_at','DESC')
                     ->select('title','description')
                     ->limit(10)
                     ->get();

      $rastriyagorkhaayojans = RastriyaGauravAyojana::where('is_active', true)
                                                    ->orderBy('sort_id','ASC')
                                                    ->select('title','link','description')
                                                    ->take(6)
                                                    ->get();
      $galleryhasimages = GalleryHasImage::where('is_active', true)
                                         ->orderBy('sort_id','ASC')
                                         ->orderBy('created_at','DESC')
                                         ->take('6')
                                         ->get();

      // notice
      // tab
      $notice_list = Notice::where('is_active', true)
                            ->where('is_pop', true)
                            ->orderBy('sort_id','ASC')
                            ->select('title', 'description', 'image_enc')
                            ->take(3)
                            ->get();

      // for pop
      $notice_pop_bulletine = Notice::where('is_active', true)
                            // ->where('page','6')
                            ->where('page','1')
                                    ->where('is_pop', true)
                                    ->orderBy('sort_id','ASC')
                                    ->select('id','title', 'description', 'image_enc','ext','duration','is_pop')
                                    ->latest()
                                    ->first();
                          // dd(date('Y-m-d', strtotime($notice_pop_bulletine->duration. ' + 1 days')));
                          // dd(date('Y-m-d', strtotime($notice_pop_bulletine->duration. ' + 1 days')) <= date('Y-m-d'));
      if ($notice_pop_bulletine) {
        if ($notice_pop_bulletine->is_pop != Null && $notice_pop_bulletine->is_pop != 0 && $notice_pop_bulletine->duration != Null) {
          if (date('Y-m-d', strtotime($notice_pop_bulletine->duration. ' + 1 days')) <= date('Y-m-d')) {
            $data_update = Notice::findOrFail($notice_pop_bulletine->id);

            $data_update->update([
              'is_pop' => False,
            ]);
            $notice_pop_bulletine = False;
          }
        }
      }

      $procurement_notice = Notice::where('is_active', true)
                          ->where('page','2')
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('id','title','slug','date', 'description', 'image_enc','remark','contract_id','status','duration')
                          ->take(4)
                          ->get();
      if ($procurement_notice) {
        foreach ($procurement_notice as $key => $value) {
                          // dd(date('Y-m-d', strtotime($value->duration. ' + 1 days')) <= date('Y-m-d'));
          if ($value->status != Null && $value->status != 0 && $value->duration != Null) {
            if (date('Y-m-d', strtotime($value->duration. ' + 1 days')) <= date('Y-m-d')) {
              $data_update = Notice::findOrFail($value->id);
              $data_update->update([
                'status' => False,
              ]);
              $procurement_notice[$key]['status'] = False;
            }
          }
        }
      }

      $posting_notice = Notice::where('is_active', true)
                          ->where('page','3')
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('title','slug','date','description', 'image_enc')
                          ->take(6)
                          ->get();   

      $general_notice = Notice::where('is_active', true)
                          ->where('page','1')
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('title','slug','date', 'description', 'image_enc')
                          ->take(3)
                          ->get();  

      $bulletin_noticeboards = Notice::where('is_active', true)
                          ->where('page','6')
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('title','slug','date','description', 'image_enc','ext')
                          ->take(3)
                          ->get();                                                               
                          // dd($notice_all);
                          // 
      $document_actregulation = Document::where('is_active', true)
                                ->where('page','1')
                                ->orderBy('sort_id','ASC')
                                ->orderBy('created_at','DESC')
                                ->select('title','slug','image_enc','remark','created_at','page')
                                ->take(3)
                                ->get();

      $division_sections = DivisionSection::where('is_active', true)
                                ->orderBy('sort_id','ASC')
                                ->orderBy('created_at','ASC')
                                ->select('title','image_enc','ext','description','page')
                                ->take(8)
                                ->get();

      $citizen_charters = CitizenCharter::where('is_active', true)
                                          ->orderBy('sort_id','ASC')
                                          ->orderBy('created_at','DESC')
                                          ->select('title','slug', 'description', 'image_enc','created_at')
                                          ->take(3)
                                          ->get();
                                                        
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(5)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      return view('web.welcome',compact('notice_top','usefullinks','quickmenus','contacts','sliders','abouts','rastriyagorkhaayojans','galleryhasimages','notice_top','notice_pop_bulletine','procurement_notice','posting_notice','general_notice','bulletin_noticeboards','document_actregulation','division_sections','citizen_charters','mantri','sachib','prabakta_suchana_adhikari'));
    }

    public function rastriyaAyojana(){
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(3)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $data_lists = RastriyaGauravAyojana::where('is_active', true)
                                        ->orderBy('sort_id','ASC')
                                        ->orderBy('created_at','DESC')
                                        ->select('title','description','link')
                                        ->get(); 

      return view('web.rastriya_gorkha_ayojan.index', compact(['notice_top','usefullinks','quickmenus','contacts','data_lists']));
    }

    public function aboutUs(){
      // for all page
      $notice_top = $this->allNotice(6)['notice'];
      $usefullinks = $this->allUsefulLink(5)['usefullink'];
      $quickmenus = $this->allQuickMenu(3)['quickmenu'];
      $contacts = $this->allContact(1)['contact'];

      $data_lists = About::where('is_active', true)
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('title','description')
                          ->get(); 

      return view('web.about_us', compact(['notice_top','usefullinks','quickmenus','contacts','data_lists']));
    }

    public function setLang(Request $request){
      $lang = $request->lang;
      // App::setlocale($lang);
      Session::put('locale', $lang);
      $ab = Session::get('locale');
      App::setLocale($lang);
      $locale = App::getLocale();
      // var_dump($lang,$ab,$locale); die();
    }

    public function switchLang(Request $request)
    {
        session(['APP_LOCALE' => $request->lang]);
        return back();
    }

    public function switchBand(Request $request)
    {
         session(['APP_BAND' => $request->lang]);        
        return back();
    }
}