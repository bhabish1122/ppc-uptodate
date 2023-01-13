<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mission;
use App\Helper\Helper;
use Auth;
use DataTables;

class MissionController extends Controller
{
  public function index(Request $request){
    return view('admin.mission.index');
  }

  public function create()
  {
      return view('admin.mission.create');
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'description' => 'required',
    ]);

    Mission::create([
      'description' => $request['description'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => ' Mission Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.mission.index')->with($pass);
  }


  public function edit($id){
    $missions = Mission::findOrFail($id);
    return view('admin.mission.edit', compact('missions'));

  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'description' => 'required',
    ]);
    $data_update = Mission::findOrFail($id);

    $data_update->update([
      'description' => $request['description'],
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Mission Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.mission.index')->with($pass);

  }

  public function destroy($id){
    $data_destroy = Mission::findOrFail($id);
    if($data_destroy->delete()){
      $pass = array(
          'message' => 'Mission Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'Mission could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.mission.index')->with($pass);

  }

  public function status($id, $avi){
    $user = Mission::findOrFail($id);
    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => 'Mission is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => 'Mission is inactive!',
        'alert-type' => 'error'
      );
    }

    $user->save();
    return back()->with($notification)->withInput();

  }

  public function getMissionList(Request $request)
  {

    $data = Mission::orderBy('id','DESC');

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.mission.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.mission.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.mission.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.mission.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['action','is_active','created_at'])
    ->make(true);

  }
}
