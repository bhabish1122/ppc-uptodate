<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\SectionDetail;
use File;
use Auth;
use Image;

class SectionDetailController extends Controller
{
  public function index(Request $request){
    $posts = SectionDetail::orderBy('id','DESC');
    if(empty($request->search))
    {            
      $posts = $posts;
    }
    else{
      $search = $request->search;
      $posts = $posts->where('image', 'LIKE',"%{$search}%");
    }
    $posts = $posts->paginate(15);
    $response = [
      'pagination' => [
        'total' => $posts->total(),
        'per_page' => $posts->perPage(),
        'current_page' => $posts->currentPage(),
        'last_page' => $posts->lastPage(),
        'from' => $posts->firstItem(),
        'to' => $posts->lastItem()
      ],
      'section_details' => $posts
    ];
    return response()->json($response);
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'photo' => 'required', //|mimes:jpg
    ]);

    $file = $request->file('photo');
    $destinationPath = 'files/section_detail';
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
  // $destinationThumbPath = 'files/section_detail/thumbnail/'.$name_enc);
  // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
    $file->move($destinationPath, $name_enc);
    SectionDetail::create([
      'title' => $request->title,
      'designation' => $request->designation,
      'department' => $request->department,
      'contact_no' =>$request->contact_no ,
      'email' => $request->email,
      'image' => $name,
      'image_enc' => $name_enc,
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);
    return ['message' => 'SectionDetail Created'];
  }

  public function edit($id){
    $categories = SectionDetail::findOrFail($id);
    return response()->json([
      'categories'=>$categories
    ],200);
  }

  public function update(Request $request, $id)
  {   
    $user = SectionDetail::findOrFail($id);
    $name = SectionDetail::where('id',$id)->value('image');
    $name_enc = SectionDetail::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:pdf',
      ]);
      $path_old_file = 'files/section_detail/'.$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'files/section_detail';
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
  // $destinationThumbPath = 'files/section_detail/thumbnail/'.$name_enc);
  // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      unlink($path_old_file);
    }
    $user->update([
  // 'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'updated_by' => Auth::user()->id,
    ]);
    return ['message' => 'SectionDetail Updated'];
  }

  public function destroy($id){
    $data_delete = SectionDetail::findOrFail($id);
    if (file_exists('files/section_detail/'.$data_delete->image_enc)) {
      unlink('files/section_detail/'.$data_delete->image_enc);
    }
    $data_delete->delete();
    return ['message'=>'ok'];
    }

  public function status($id, $avi){
    $user = SectionDetail::findOrFail($id);
    $user->is_active = !$avi;
    $user->save();
  }
}
