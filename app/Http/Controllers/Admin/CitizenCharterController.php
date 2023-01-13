<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\CitizenCharter;
use Auth;
use File;
use Image;
use DataTables;

class CitizenCharterController extends Controller
{
  public function index(Request $request){
    return view('admin.citizen_charter.index');
  }

  public function create()
  {
      return view('admin.citizen_charter.create');
  }

  public function store(Request $request)
  {  
    // $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con(); 
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999);
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
      'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
    ]);
    $file = $request->file('photo');
    $destinationPath = 'files/citizen_charter'; // upload path
    $destinationPath1 = 'files/citizen_charter/thumbnail';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $ext = $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    if($ext == 'jpg'){
    $destinationThumbPath = 'files/citizen_charter/thumbnail/'.$name_enc; // upload path
    Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
    }

    $file->move($destinationPath, $name_enc);

    CitizenCharter::create([
      'title' => $request['title'],
      'slug' => $request['slug'],
      'description' => $request['description'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $ext,
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => $request['title'].'Document Created!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.citizen_charter.index')->with($pass);
  }

  public function edit($id){
    $citizen_charters = CitizenCharter::findOrFail($id);
    return view('admin.citizen_charter.edit',compact('citizen_charters'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
    ]);
    $data_update = CitizenCharter::findOrFail($id);

    $name = CitizenCharter::where('id',$id)->value('image');
    $name_enc = CitizenCharter::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
      ]);
      $path_old_file = "files/citizen_charter/".$name_enc;
      $path_old_file_thumb = "files/citizen_charter/thumbnail/".$name_enc;
      
      $file = $request->file('photo');
      $destinationPath = 'files/citizen_charter'; // upload path
      $destinationPath1 = 'files/citizen_charter/thumbnail';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $ext = $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      if($ext == 'jpg' || $ext == 'jpeg')
      {
        $destinationThumbPath = 'files/citizen_charter/thumbnail/'.$name_enc; // upload path
        Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);

        unlink($path_old_file_thumb);
      }
      $file->move($destinationPath, $name_enc);
      unlink($path_old_file);
    }

    $data_update->update([
      'title' => $request['title'],
      'description' => $request['description'],
      'image' => $name,
      // 'ext' => $ext,
      'image_enc' => $name_enc,
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'CitizenCharter Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.citizen_charter.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = CitizenCharter::findOrFail($id);
    if (file_exists('files/citizen_charter/'.$data_destroy->image_enc)) {
      unlink('files/citizen_charter/'.$data_destroy->image_enc);
      if (file_exists('files/citizen_charter/thumbnail/'.$data_destroy->image_enc)) {
        unlink('files/citizen_charter/thumbnail/'.$data_destroy->image_enc);
      }
    }

    if($data_destroy->delete()){
      $pass = array(
          'message' => 'CitizenCharter Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'CitizenCharter could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.citizen_charter.index')->with($pass);

  }

  public function status($id, $avi){
    $user = CitizenCharter::findOrFail($id);
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

  public function getCitizenCharterList(Request $request)
  {

    $data = CitizenCharter::orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('link', function($row){
      if($row->image_enc){
        $url=asset("files/citizen_charter/$row->image_enc"); 
        $action = '<a href="'.$url.'" class="btn btn-sm btn-outline-danger" target="_blank"  data-toggle="tooltip" data-placement="top" >'.$row->ext.'</a>';
      }
      else{
        $action = '';
      }
      
      return $action;

    })
   
    ->addColumn('type', function($row){
        if ($row->page == 1) {
          $action = 'Acts';
        }
        else if($row->page == 2) {
          $action = 'Regulations';
        }
        else if($row->page == 3) {
          $action = 'Directory';
        }
        else if($row->page == 4) {
          $action = 'Nirdeshika';
        }
        else if($row->page == 5) {
          $action = 'Other';
        }
        else if($row->page == 6) {
          $action = 'Download';
        }
        else{
          $action = 'Yearly Budget';
        }
       
         return $action;

    })
    
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.citizen_charter.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.citizen_charter.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.citizen_charter.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.citizen_charter.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['type','link','action','is_active','created_at'])
    ->make(true);

  }
}
