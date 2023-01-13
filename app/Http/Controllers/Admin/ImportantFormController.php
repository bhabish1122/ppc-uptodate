<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Http\Request;

use App\Form;
use Auth;

class ImportantFormController extends Controller
{
  public function index(){
    return view("admin.important_form.index");
  }
  public function create(){
    return view("admin.important_form.create");
  }
  
  public function store(Request $request){
    return $request;
  }
  public function edit(Request $request){
   
  }
  public function update(Request $request){
   
  }
  public function delete(Request $request){
   
  }
}
