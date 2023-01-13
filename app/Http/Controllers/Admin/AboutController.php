<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Http\Request;

use App\About;
use Auth;
use DataTables;

class AboutController extends Controller
{
  public function index(Request $request){

    return view('admin.about.index');

  }

  public function create()
  {
      return view('admin.about.create');
  }

  public function store(Request $request)
  {  
    $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con(); 
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);

    About::create([
      'title' => $request['title'],
      'slug' => $request['slug'],
      'description' => $request['description'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => $request['title'].' Link Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.about.index')->with($pass);
  }


  public function edit($id){
    $abouts = About::findOrFail($id);
    return view('admin.about.edit', compact('abouts'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);
    $data_update = About::findOrFail($id);

    $data_update->update([
      'title' => $request['title'],
      'description' => $request['description'],
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'About Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.about.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = About::findOrFail($id);
    if($data_destroy->delete()){
      $pass = array(
          'message' => 'About Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'About could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return redirect()->route('admin.about.index')->with($pass);

  }

  public function status($id, $avi){
    $user = About::findOrFail($id);
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

  public function getAboutList(Request $request)
  {

    $data = About::orderBy('id','DESC');

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.about.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

        if ($row->is_active == 1) {
          $action = $action.'<i class="fa fa-check" title="Click to leave"></i>
            </a>';
        } else {
          $action = $action.'<i class="fa fa-times text-danger" title="Click to undo leave"></i>
            </a>';
        }
        return $action;

    })
    ->addColumn('description', function($row){
      return strip_tags($row->description);

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);

      $action = '<a href="'.route('admin.about.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 

      <a href="#"  data-url="'.route('admin.about.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.about.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['action','is_active','created_at'])
    ->make(true);

  }
}
