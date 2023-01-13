<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\ImportantForm;
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
  
  public function store(Request $request)
  {  
    // $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con(); 
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999);
    $this->validate($request, [
      'page' => 'required',
      'title' => 'required',
      'remark' => 'required',
      'photo' => 'required',
    ]);
    
    if($request->hasFile('photo')){
        $this->validate($request, [
            'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
        ]);
        $file = $request->file('photo');
    $destinationPath = 'files/document';
    if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $ext = $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    // $destinationThumbPath = 'files/document/thumbnail/'.$name_enc);
    // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
        $file->move($destinationPath, $name_enc);
    }
    
    
    $document = ImportantForm::create([
      'title' => $request['title'],
      'slug' => $request['slug'],
      'image' => $request->hasFile('photo') ? $name : Null,
      'image_enc' => $request->hasFile('photo') ? $name_enc : Null,
      'remark' => $request['remark'],
      'page' => $request['page'],
      'ext' => $request->hasFile('photo') ? $ext : Null,
      'is_active' => '1',
      'created_by' => Auth::user()->id,
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
    ]);

    $pass = array(
        'message' => 'Important Form Created!',
        'alert-type' => 'success'
    );
    return back();
  }
  public function edit(Request $request){
   
  }
  public function update(Request $request){
   
  }
  public function delete(Request $request){
   
  }
}
