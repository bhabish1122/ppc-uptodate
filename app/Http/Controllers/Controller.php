<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\UsefulLink;
use App\QuickMenu;
use App\Contact;
use App\Notice;

use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request, Helper $helper, Guard $auth)
    {
      $this->request = $request;
      $this->helper = $helper;
    }

    public function allUsefulLink($request){
      // dd($request);
      $usefullinks = UsefulLink::where('is_active', true)
                               ->orderBy('sort_id','DESC')
                               ->orderBy('created_at','DESC')
                               ->select('title','link')
                               ->get();
      return [
        'usefullink' => $usefullinks, 
        ];
    }

    public function allQuickMenu($request){
      // dd($request);
      $quickmenus = QuickMenu::where('is_active', true)
                             ->orderBy('sort_id','DESC')
                             ->orderBy('created_at','DESC')
                             ->select('title','link')
                             ->get();
      return [
        'quickmenu' => $quickmenus, 
        ];
    }

    public function allContact($request){
      // dd($request);
      $contacts = Contact::where('is_active', true)
                         ->orderBy('sort_id','DESC')
                         ->orderBy('created_at','DESC')
                         ->take(1)
                         ->get();
      return [
        'contact' => $contacts
        ];
    }

    public function allNotice($request){
      $notice_list = Notice::where('is_active', true)
                          ->where('is_top', true)
                          // ->where('status', true)
                          ->orderBy('sort_id','ASC')
                          ->orderBy('created_at','DESC')
                          ->select('title','slug')
                          ->take(6)
                          ->get();
      return [
        'notice' => $notice_list
        ];
    }

    public static function createPathDiretory($path_dir, $abs = true) {


        if (!is_dir($path_dir)) {
            //create the path with permission to read and write
            mkdir($path_dir, 0777, true);
        }
        return ($abs ? $path_dir : $path_dir);
    }

    // public function allNoticePage($request){
    //   $notice_list = Notice::where('is_active', true)
    //                       ->orderBy('sort_id','ASC')
    //                       ->orderBy('created_at','DESC');
    //   return [
    //     'notice' => $notice_list
    //     ];
    // }
}