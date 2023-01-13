<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Http\Request;

use App\Form;
use Auth;

class FormController extends Controller
{
  public function index(Request $request){
    $posts = Form::orderBy('id','DESC')->where('form_type','2')->paginate(15);
    return view('admin.form.complain',compact('posts'));
  }

  public function suggestion(Request $request){
    $posts = Form::orderBy('id','DESC')->where('form_type','1')->paginate(15);
    return view('admin.form.suggestion',compact('posts'));
  }

  public function report(Request $request){
    $posts = Form::orderBy('id','DESC')->where('form_type','3')->paginate(15);
    return view('admin.form.report',compact('posts'));
  }
}
