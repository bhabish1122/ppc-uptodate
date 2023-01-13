<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Gallery;
use App\GalleryHasImage;
use Auth;
use DataTables;
class GalleryController extends Controller
{
  public function index(Request $request){
    return view('admin.gallery.index');
  }

  public function create()
  {
      return view('admin.gallery.create');
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
      'type' => '0',
      'is_active' => '1',
      'created_by' => Auth::user()->id,
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
    ]);
    $pass = array(
        'message' => ' Gallery Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.gallery.index')->with($pass);
  }

  public function edit($id){
    $visions = Gallery::findOrFail($id);
    return view('admin.gallery.edit', compact('visions'));

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
    return redirect()->route('admin.gallery.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = Gallery::findOrFail($id);
    if($data_destroy->delete()){
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
    return redirect()->route('admin.gallery.index')->with($pass);
  }

  public function status($id, $avi){
    $user = Gallery::findOrFail($id);
    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => 'Gallery is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => 'Gallery is inactive!',
        'alert-type' => 'error'
      );
    }

    $user->save();
    return back()->with($notification)->withInput();
  }

  public function getGalleryList(Request $request)
  {

    $data = Gallery::where('type',0)->orderBy('id','DESC');


    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.gallery.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      return strip_tags($row->title);

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.gallery.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 

      <a href="'.route('admin.gallery.show',$row->id).'" class="btn btn-sm btn-flat btn-outline-info"><i class="fas fa-plus" title="Click to View"></i></a> 

      <a href="#" data-url="'.route('admin.gallery.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.gallery.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['action','is_active','created_at'])
    ->make(true);

  }

  

  public function show(Request $request, $id)
  {
    // galleryhasimage
    $gallery = Gallery::findOrFail($id);
    return view('admin.gallery.galleryhasimage.index', compact('gallery'));
    return $id;
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
