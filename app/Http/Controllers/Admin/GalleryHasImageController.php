<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\GalleryHasImage;
use App\Gallery;
use File;
use Auth;
use Image;
use DataTables;
class GalleryHasImageController extends Controller
{
  public function getGalleryHasImageList($id, Request $request)
  {

    $data = GalleryHasImage::where('gallery_id',$id)->orderBy('id','DESC');

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.gallery_has_image.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

        if ($row->is_active == 1) {
          $action = $action.'<i class="fa fa-check" title="Click to Deactivate"></i>
            </a>';
        } else {
          $action = $action.'<i class="fa fa-times text-danger" title="Click to make Active"></i>
            </a>';
        }
        return $action;

    })
    ->addColumn('description', function($row){
      $url=asset("image/gallery_has_image/thumbnail/$row->image_enc"); 
      return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';
    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '
      <a href="#" data-url="'.route('admin.gallery_has_image.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.gallery_has_image.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['action','is_active','created_at','description'])
    ->make(true);

  }
  public function index(Request $request){
    dd('gallery_image_index');
  }
  public function create1($id){
    $gallery = Gallery::findOrFail($id);
    return view('admin.gallery.galleryhasimage.create', compact('gallery'));
  }
  public function store(Request $request)
  {  
    // var_dump($request->file('photos_array')); 
    // var_dump($request->photos_array); 
    // dump($request);
    // die;
    $this->validate($request, [
      'gallery_id' => 'required',
      'photos_array' => 'required',
      'photos_array.*' => 'mimes:jpg,jpeg'
    ]);

    $files = $request->file('photos_array');
    foreach ($files as $key => $file) {
    // dump($file);
      $destinationPath = 'image/gallery_has_image';
      $destinationPath1 = 'image/gallery_has_image/thumbnail';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis').$key. "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/gallery_has_image/thumbnail/'.$name_enc;
      Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      GalleryHasImage::create([
        'gallery_id' => $request['gallery_id'],
        'title' => 'a',
        'description' => 'j',
        'image' => $name,
        'image_enc' => $name_enc,
        'is_active' => '1',
        'created_by' => Auth::user()->id,
        'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      ]);
    }
    $pass = array(
        'message' => ' Gallery Image Added.',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.gallery.show',$request['gallery_id'])->with($pass);
    return back()->with($pass);
  }

  public function edit($id){
    $edit_data = GalleryHasImage::findOrFail($id);
    return response()->json([
      'edit_data'=>$edit_data
    ],200);
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
    ]);
    $user = GalleryHasImage::findOrFail($id);
    $gallery_id = GalleryHasImage::where('id',$id)->value('gallery_id');
    $name = GalleryHasImage::where('id',$id)->value('image');
    $name_enc = GalleryHasImage::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:jpg,jpeg|max:5024',
      ]);
      $path_old_file = "image/gallery_has_image/".$name_enc;
      $path_old_file_thumb = "image/gallery_has_image/thumbnail/".$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'image/gallery_has_image';
      $destinationPath1 = 'image/gallery_has_image/thumbnail';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/gallery_has_image/thumbnail/'.$name_enc;
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
    return ['message' => 'GalleryHasImage Updated'];
  }

  public function destroy($id){
    $usertype = GalleryHasImage::findOrFail($id);
    if(file_exists('image/gallery_has_image/'.$usertype->image_enc)){
      unlink('image/gallery_has_image/'.$usertype->image_enc);
      unlink('image/gallery_has_image/thumbnail/'.$usertype->image_enc);
    }
    if($usertype->delete()){
      $pass = array(
          'message' => 'Gallery Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'Gallery could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return back()->with($pass);
  }

  public function status($id, $avi){
    $user = GalleryHasImage::findOrFail($id);
    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => 'Image is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => 'Image is inactive!',
        'alert-type' => 'error'
      );
    }

    $user->save();
    return back()->with($notification)->withInput();
  }

  public function folderTitle(Request $request, $id){
    $response = [
      'title' => Gallery::where('id',$id)->value('title'),
    ];
    return response()->json($response);
  }
}
