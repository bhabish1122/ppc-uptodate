<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery;
use App\GalleryHasImage;
use Auth;
use DataTables;

class VideoGalleryController extends Controller
{
  public function index(Request $request){
    return view('admin.video_gallery.index');
  }

  public function create()
  {
      return view('admin.video_gallery.create');
  }

  public function store(Request $request)
  {  
    // $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con();
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999); 
    $this->validate($request, [
      'title' => 'required',
    ]);


    Gallery::create([
      'title' => $request['title'],
      'slug' => $request['slug'],
      'is_active' => '1',
      'type' => '1',
      'link' => $request['link'],
      'created_by' => Auth::user()->id,
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
    ]);

    $pass = array(
        'message' => $request['title'].' Link Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.video-gallery.index')->with($pass);

    return ['message' => 'Gallery Created'];
  }

  public function edit($id){
    $video_gallerys = Gallery::findOrFail($id);
    return view('admin.video_gallery.edit', compact('video_gallerys'));

    return response()->json([
      'edit_data'=>$edit_data
    ],200);
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
    ]);
    $user = Gallery::findOrFail($id);

    $user->update([
      'title' => $request['title'],
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Gallery Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.video-gallery.index')->with($pass);

  }

  public function destroy($id){
    $data_delete = Gallery::findOrFail($id);
    if($data_delete->delete()){
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
    return redirect()->route('admin.video-gallery.index')->with($pass);

  
  }

  public function status($id, $avi){
    $user = Gallery::findOrFail($id);
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

  public function getVideoGalleryList(Request $request)
  {

    $data = Gallery::where('type',1)->orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.video-gallery.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.video-gallery.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.video-gallery.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.video-gallery.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['action','is_active','created_at'])
    ->make(true);

  }

  public function show(Request $request, $id)
  {
    $gallery_id = $request->gallery_id;
    $posts = GalleryHasImage::where('gallery_id',$gallery_id)
                            ->orderBy('id','DESC');
    if(empty($request->search))
    {            
      $posts = $posts;
    }
    else{
      $search = $request->search;
      $posts = $posts->where('title', 'LIKE',"%{$search}%");
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
      'gallery_has_images' => $posts,
      'gallery_id' => $request->gallery_id,
      'title' => Gallery::where('id',$gallery_id)->value('title'),
    ];
    return response()->json($response);
  }
}
