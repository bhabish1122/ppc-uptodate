<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\BackgroundSlider;
use File;
use Auth;
use Image;
use DataTables;

class BackgroundSliderController extends Controller
{
  public function index(Request $request){
    return view('admin.background_slider.index');
  }

  public function create()
  {
      return view('admin.background_slider.create');
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'title' => 'required',
      'photo' => 'required|mimes:jpg,jpeg|max:5024',
    ]);

    $file = $request->file('photo');
    $destinationPath = 'image/background_slider'; // upload path
    $destinationPath1 = 'image/background_slider/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    $destinationThumbPath = 'image/background_slider/thumbnail/'.$name_enc; // upload path
    Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
    $file->move($destinationPath, $name_enc);

    BackgroundSlider::create([
      'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => ' BackgroundSlider Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.bg_slider.index')->with($pass);
  }

  public function edit($id){
    $background_sliders = BackgroundSlider::findOrFail($id);
    return view('admin.background_slider.edit', compact('background_sliders'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
        'title' => 'required',
    ]);
    $user = BackgroundSlider::findOrFail($id);
    $name = BackgroundSlider::where('id',$id)->value('image');
    $name_enc = BackgroundSlider::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:jpg,jpeg|max:5024',
      ]);
      $path_old_file = "image/background_slider/".$name_enc;
      $path_old_file_thumb = "image/background_slider/thumbnail/".$name_enc;
      
      $file = $request->file('photo');
      $destinationPath = 'image/background_slider'; // upload path
       $destinationPath1 = 'image/background_slider/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/background_slider/thumbnail/'.$name_enc; // upload path
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
        'message' => 'BackgroundSlider Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.bg_slider.index')->with($pass);
  }

  public function destroy($id){
    $usertype = BackgroundSlider::findOrFail($id);
    if(file_exists('image/background_slider/'.$usertype->image_enc)){
      unlink('image/background_slider/'.$usertype->image_enc);
    }
    if(file_exists('image/background_slider/thumbnail/'.$usertype->image_enc)){      
      unlink('image/background_slider/thumbnail/'.$usertype->image_enc);
    }

    if($usertype->delete()){
      $pass = array(
          'message' => 'BackgroundSlider Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'BackgroundSlider could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.bg_slider.index')->with($pass);

  }

  public function status($id, $avi){
    $user = BackgroundSlider::findOrFail($id);
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

  public function getBackgroundSliderList(Request $request)
  {

    $data = BackgroundSlider::orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.bg_slider.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $url=asset("image/background_slider/$row->image_enc"); 
      return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.bg_slider.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.bg_slider.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.bg_slider.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['image','action','is_active','created_at'])
    ->make(true);

  }
}
