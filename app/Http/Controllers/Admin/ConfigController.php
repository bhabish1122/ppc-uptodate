<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Config;
use File;
use Auth;
use Image;

class ConfigController extends Controller
{
  public function index(Request $request){
    $posts = Config::orderBy('id','DESC');
    $configs = $posts->paginate(15);
    return view('admin.config.index',compact('configs'));
  }

  public function create()
  {
      return view('admin.config.create');
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'title' => 'required',
      'address' => 'required',
      'office' => 'required',
      'title_np' => 'required',
      'address_np' => 'required',
      'office_np' => 'required',
      'photo' => 'required|mimes:png|max:1024',
    ]);

    $file = $request->file('photo');
    $destinationPath = 'image/config';
    $destinationPath1 = 'image/config/thumbnail';
    if (!is_dir($destinationPath)) {
      static::createPathDiretory($destinationPath);
    }
    if (!is_dir($destinationPath1)) {
      static::createPathDiretory($destinationPath1);
    }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    $destinationThumbPath = 'image/config/thumbnail/'.$name_enc;
    Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
    $file->move($destinationPath, $name_enc);
    Config::create([
      'title' => $request['title'],
      'address' => $request['address'],
      'office' => $request['office'],
      'title_np' => $request['title_np'],
      'address_np' => $request['address_np'],
      'office_np' => $request['office_np'],
      'image' => $name,
      'image_enc' => $name_enc,
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Config Created!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.config.index')->with($pass);

  }

  public function edit($id){
    $configs = Config::findOrFail($id);
    return view('admin.config.edit', compact('configs'));
  }


  public function update(Request $request, $id)
  {   
    // dd('ll');
    
    $this->validate($request, [
      'title' => 'required',
      'office' => 'required',
      'address' => 'required',
      'title_np' => 'required',
      'address_np' => 'required',
      'office_np' => 'required',
    ]);
    $user = Config::findOrFail($id);
    $name = Config::where('id',$id)->value('image');
    $name_enc = Config::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:png|max:1024',
      ]);
      $path_old_file = "image/config/".$name_enc;
      $path_old_file_thumb = "image/config/thumbnail/".$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'image/config';
      $destinationPath1 = 'image/config/thumbnail';
      if (!is_dir($destinationPath)) {
        static::createPathDiretory($destinationPath);
      }
      if (!is_dir($destinationPath1)) {
        static::createPathDiretory($destinationPath1);
      }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/config/thumbnail/'.$name_enc;
      Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      unlink($path_old_file);
      unlink($path_old_file_thumb);
    }
    $user->update([
      'title' => $request['title'],
      'office' => $request['office'],
      'address' => $request['address'],
      'title_np' => $request['title_np'],
      'address_np' => $request['address_np'],
      'office_np' => $request['office_np'],
      'image' => $name,
      'image_enc' => $name_enc,
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Config Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.config.index')->with($pass);

    // return ['message' => 'Config Updated'];
  }

  public function destroy($id){
    $usertype = Config::findOrFail($id);
    if (file_exists('image/config/'.$usertype->image_enc)) {
      unlink('image/config/'.$usertype->image_enc);
      unlink('image/config/thumbnail/'.$usertype->image_enc);
    }
    if($usertype->delete()){
      $pass = array(
          'message' => 'Config Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'Config could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.config.index')->with($pass);

  }

  public function status($id, $avi){
    $user = Config::findOrFail($id);
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
}