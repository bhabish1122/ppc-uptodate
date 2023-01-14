<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\ImportantForm;
use Illuminate\Http\Request;

use App\Form;
use Auth;
use DataTables;

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
    $destinationPath = 'files/importantform';
    if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $ext = $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    // $destinationThumbPath = 'files/importantform/thumbnail/'.$name_enc);
    // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
        $file->move($destinationPath, $name_enc);
    }
    
    
    $importantform = ImportantForm::create([
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
    return redirect()->route('admin.importantform.index')->with($pass);
  }

  public function edit($id){
    $importantforms = ImportantForm::findOrFail($id);
    return view('admin.important_form.edit',compact('importantforms'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'page' => 'required',
      'remark' => 'required',
    ]);
    $user = ImportantForm::findOrFail($id);
    $name = ImportantForm::where('id',$id)->value('image');
    $name_enc = ImportantForm::where('id',$id)->value('image_enc');
    $name_ext = ImportantForm::where('id',$id)->value('ext');
    if($request->hasFile('photo')){
      $path_old_file = "files/importantform/".$name_enc;
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
      ]);
      $file = $request->file('photo');
      $destinationPath = 'files/importantform';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
// $destinationThumbPath = 'files/importantform/thumbnail/'.$name_enc);
// Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      $name_ext = $file->getClientOriginalExtension();
      unlink($path_old_file);
    }
    $user->update([
      'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $name_ext,
      'page' => $request['page'],
      'remark' => $request['remark'],
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Important Form Updated!',
        'alert-type' => 'success'
    );

    return redirect()->route('admin.importantform.index')->with($pass);
  }

  public function destroy($id){
    $data_delete = ImportantForm::findOrFail($id);
    if (file_exists('files/importantform/'.$data_delete->image_enc)) {
      unlink('files/importantform/'.$data_delete->image_enc);
    }
    if($data_delete->delete()){
      $pass = array(
          'message' => 'Important Form Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'Important Form could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return response()->json($pass);
    return redirect()->route('admin.importantform.index')->with($pass);

  }

  public function status($id, $avi){
    $user = ImportantForm::findOrFail($id);
    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => $user->title.' is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => $user->title.' is inactive!',
        'alert-type' => 'error'
      );
    }
    $user->save();    
    return back()->with($notification)->withInput();

  }

  public function getImportantFormList(Request $request)
  {

    $page = $request->page;

    $data = ImportantForm::orderBy('id','DESC');

    if(!empty($request->page))
    {  
      $page = $request->page;          
      $data = $data->where('page', 'LIKE',"%{$page}%");
    }

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('link', function($row){
      if($row->image_enc){
        $url=asset("files/importantform/$row->image_enc"); 
        $action = '<a href="'.$url.'" class="btn btn-sm btn-outline-danger" target="_blank"  data-toggle="tooltip" data-placement="top" >'.$row->ext.'</a>';
      }
      else{
        $action = '';
      }
      
      return $action;

    })
   
    ->addColumn('type', function($row){
        if ($row->page == 1) {
          $action = 'Daily Form';
        }
        else if($row->page == 2) {
          $action = 'Other';
        }
        else if($row->page == 3) {
          $action = 'Information collection form';
        }
        else{
          $action = '';
        }
       
         return $action;

    })
    
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.importantform.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

        if ($row->is_active == 1) {
          $action = $action.'<i class="fa fa-check" title="Click to leave"></i>
            </a>';
        } else {
          $action = $action.'<i class="fa fa-times text-danger" title="Click to undo leave"></i>
            </a>';
        }
        return $action;

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.importantform.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.importantform.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.importantform.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['type','link','action','is_active','created_at'])
    ->make(true);

  }
}
