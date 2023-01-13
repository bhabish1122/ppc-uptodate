<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $lang = $request->lang;
        // App::setlocale($lang);
        $request->session()->put('locale', $lang);
        // $ab = $request->session()->get('locale');
        // App::setLocale($lang);
        // $locale = App::getLocale();
        // var_dump($lang,$locale); die();
    }
}
