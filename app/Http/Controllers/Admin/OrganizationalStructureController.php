<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrganizationalStructure;
use App\Helper\Helper;
use File;
use Auth;
use Image;
use DataTables;

class OrganizationalStructureController extends Controller
{
  public function index(Request $request){
    return view('admin.organizational_structure.index');
  }

  public function create()
  {
      return view('admin.organizational_structure.create');
  }

  public function store(Request $request)
  {  
    //   var_dump($request['title']); die();
    $this->validate($request, [
      'photo' => 'required|mimes:jpg,jpeg|max:5024',
    ]);

    $file = $request->file('photo');
    // var_dump($file); die;
    $destinationPath = 'image/organizational_structure';
     $destinationPath1 = 'image/organizational_structure/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    $destinationThumbPath = 'image/organizational_structure/thumbnail/'.$name_enc;
    Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
    $file->move($destinationPath, $name_enc);

    OrganizationalStructure::create([
      'title' => $request['title'],
      'page' => 1,
      'image' => $name,
      'image_enc' => $name_enc,
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => ' OrganizationalStructure Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.organizational_structure.index')->with($pass);
  }

  public function edit($id){
    $organizational_structures = OrganizationalStructure::findOrFail($id);
    return view('admin.organizational_structure.edit', compact('organizational_structures'));
  }

  public function update(Request $request, $id)
  {   
    $user = OrganizationalStructure::findOrFail($id);
    $name = OrganizationalStructure::where('id',$id)->value('image');
    $name_enc = OrganizationalStructure::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:jpg,jpeg|max:5024',
      ]);
      $path_old_file = "image/organizational_structure/".$name_enc;
      $path_old_file_thumb = "image/organizational_structure/thumbnail/".$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'image/organizational_structure';
      $destinationPath1 = 'image/organizational_structure/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/organizational_structure/thumbnail/'.$name_enc; 
      Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      unlink($path_old_file);
      unlink($path_old_file_thumb);
    }
    $user->update([
      'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'OrganizationalStructure Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.organizational_structure.index')->with($pass);
  }

  public function destroy($id){
    $usertype = OrganizationalStructure::findOrFail($id);
    if (file_exists("image/organizational_structure/".$usertype->image_enc)) {
      unlink("image/organizational_structure/".$usertype->image_enc);
      unlink("image/organizational_structure/thumbnail/".$usertype->image_enc);
    }
    if($usertype->delete()){
      $pass = array(
          'message' => 'OrganizationalStructure Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'OrganizationalStructure could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.organizational_structure.index')->with($pass);

  }

  public function status($id, $avi){
    $user = OrganizationalStructure::findOrFail($id);
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



  public function getOrganizationalStructureList(Request $request)
  {

    $data = OrganizationalStructure::where('page',1)->orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.organizational_structure.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

        if ($row->is_active == 1) {
          $action = $action.'<i class="fa fa-check" title="Click to leave"></i>
            </a>';
        } else {
          $action = $action.'<i class="fa fa-times text-danger" title="Click to undo leave"></i>
            </a>';
        }
        return $action;

    })
    ->addColumn('image', function($row){
      $url=asset("image/organizational_structure/$row->image_enc"); 
      return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.organizational_structure.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.organizational_structure.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.organizational_structure.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['image','action','is_active','created_at'])
    ->make(true);

  }
}
