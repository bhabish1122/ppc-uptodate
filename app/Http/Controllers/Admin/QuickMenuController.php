<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\QuickMenu;
use Auth;
use DataTables;


class QuickMenuController extends Controller
{
  public function index(Request $request){
    return view('admin.quick_menu.index');
  }

  public function create()
  {
      return view('admin.quick_menu.create');
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'title' => 'required',
      'title_en' => 'required',
      'link' => 'required',
    ]);

    QuickMenu::create([
      'title' => $request['title'],
      'title_en' => $request['title_en'],
      'link' => $request['link'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => $request['title'].' Link Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.quick_menu.index')->with($pass);
  }


  public function edit($id){
    $quick_menus = QuickMenu::findOrFail($id);
    return view('admin.quick_menu.edit', compact('quick_menus'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'title_en' => 'required',
      'link' => 'required',
    ]);
    $data_update = QuickMenu::findOrFail($id);

    $data_update->update([
      'title' => $request['title'],
      'title_en' => $request['title_en'],
      'link' => $request['link'],
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'QuickMenu Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.quick_menu.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = QuickMenu::findOrFail($id);
    if($data_destroy->delete()){
      $pass = array(
          'message' => 'QuickMenu Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'QuickMenu could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.quick_menu.index')->with($pass);
  }

  public function status($id, $avi){
    $user = QuickMenu::findOrFail($id);
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

  public function getQuickMenuList(Request $request)
  {

    $data = QuickMenu::orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.quick_menu.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.quick_menu.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.quick_menu.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.quick_menu.destroy', $row->id).'"></i></a>

      ';
      return $action;

    })
    ->rawColumns(['link','image','action','is_active','created_at'])
    ->make(true);

  }

}
