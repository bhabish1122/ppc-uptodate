<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Http\Request;

use App\Form;
use Auth;

class FormController extends Controller
{
  public function index(){
    return view("view.admin.important_form.index");
  }
  public function create(Request $request){
    return view("view.admin.important_form.create");
  }
  
  public function edit(Request $request){
   
  }
  public function update(Request $request){
   
  }
  public function delete(Request $request){
   
  }
}
