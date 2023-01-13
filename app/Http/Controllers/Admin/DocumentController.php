<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Str;
use App\Document;
use File;
use Auth;
use Image;
use App\Config;
use DataTables;

class DocumentController extends Controller
{
  public function index(Request $request){
    return view('admin.document.index');
  }

  public function create()
  {
      return view('admin.document.create');
  }

  public function store(Request $request)
  {  
    // $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con(); 
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999);
    $this->validate($request, [
      'page' => 'required',
      'title' => 'required',
      'remark' => 'required',
      'photo' => 'required',
    ]);
    
    if($request->hasFile('photo')){
        $this->validate($request, [
            'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
        ]);
        $file = $request->file('photo');
    $destinationPath = 'files/document';
    if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
    $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
    $ext = $file->getClientOriginalExtension();
    $name = $file->getClientOriginalName();
    // $destinationThumbPath = 'files/document/thumbnail/'.$name_enc);
    // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
        $file->move($destinationPath, $name_enc);
    }
    
    
    $document = Document::create([
      'title' => $request['title'],
      'slug' => $request['slug'],
      'image' => $request->hasFile('photo') ? $name : Null,
      'image_enc' => $request->hasFile('photo') ? $name_enc : Null,
      'remark' => $request['remark'],
      'page' => $request['page'],
      'ext' => $request->hasFile('photo') ? $ext : Null,
      'is_active' => '1',
      'created_by' => Auth::user()->id,
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
    ]);

    $pass = array(
        'message' => 'Document Created!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','act','regulation','act_rule','nirdeshika','other','download','year-program-&-budget'];
    // $date_np = $this->helper->date_np_con();
    // $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/document',[
    //     'json' => array(
    //         'id' => $document->id,
    //         'title' => $document->title,
    //         'route_url' => route('web.document.show',[$pages[$document->page],$document->slug]),
    //         'date_np' => $date_np,
    //         'page' => $document->page,
    //         'api_key' => $pages[$document->page],
    //         'server_id' => env('WEB_API_KEY'),
    //         'ministry' => $ministry,
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //   ]);

    return redirect()->route('admin.document.index')->with($pass);
  }

  public function edit($id){
    $documents = Document::findOrFail($id);
    return view('admin.document.edit',compact('documents'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'page' => 'required',
      'remark' => 'required',
    ]);
    $user = Document::findOrFail($id);
    $name = Document::where('id',$id)->value('image');
    $name_enc = Document::where('id',$id)->value('image_enc');
    $name_ext = Document::where('id',$id)->value('ext');
    if($request->hasFile('photo')){
      $path_old_file = "files/document/".$name_enc;
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
      ]);
      $file = $request->file('photo');
      $destinationPath = 'files/document';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
// $destinationThumbPath = 'files/document/thumbnail/'.$name_enc);
// Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      $name_ext = $file->getClientOriginalExtension();
      unlink($path_old_file);
    }
    $user->update([
      'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $name_ext,
      'page' => $request['page'],
      'remark' => $request['remark'],
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Document Updated!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','act','regulation','act_rule','nirdeshika','other','download','year-program-&-budget'];
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/document/update',[
    //     'json' => array(
    //         'id' => $user->id,
    //         'title' => $user->title,
    //         'route_url' => route('web.document.show',[$pages[$user->page],$user->slug]),
    //         'server_id' => env('WEB_API_KEY'),
    //         'page' => $user->page,
    //         'api_key' => $pages[$user->page],
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //     ]);

    return redirect()->route('admin.document.index')->with($pass);
  }

  public function destroy($id){
    $data_delete = Document::findOrFail($id);
    if (file_exists('files/document/'.$data_delete->image_enc)) {
      unlink('files/document/'.$data_delete->image_enc);
    }
    if($data_delete->delete()){
      $pass = array(
          'message' => 'Document Deleted!',
          'alert-type' => 'success'
      );
       // api section
      // $client = new \GuzzleHttp\Client();
      // $res = $client->request('GET', 'https://p1.gov.np/api/document',[
      //     'json' => array(
      //         'id' => $id,
      //         'server_id' => env('WEB_API_KEY'),
      //     )
      //   ]);

    }else{
      $pass = array(
          'message' => 'Document could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return response()->json($pass);
    return redirect()->route('admin.document.index')->with($pass);

  }

  public function status($id, $avi){
    $user = Document::findOrFail($id);
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
    // api section
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('GET', 'https://p1.gov.np/api/document/active',[
    //     'json' => array(
    //         'id' => $id,
    //         'avi' => $avi,
    //         'server_id' => env('WEB_API_KEY'),
    //     )
    //     ]);
    
    return back()->with($notification)->withInput();

  }

  public function getDocumentList(Request $request)
  {

    $page = $request->page;

    $data = Document::orderBy('id','DESC');

    if(!empty($request->page))
    {  
      $page = $request->page;          
      $data = $data->where('page', 'LIKE',"%{$page}%");
    }

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('link', function($row){
      if($row->image_enc){
        $url=asset("files/document/$row->image_enc"); 
        $action = '<a href="'.$url.'" class="btn btn-sm btn-outline-danger" target="_blank"  data-toggle="tooltip" data-placement="top" >'.$row->ext.'</a>';
      }
      else{
        $action = '';
      }
      
      return $action;

    })
   
    ->addColumn('type', function($row){
        if ($row->page == 1) {
          $action = 'Acts';
        }
        else if($row->page == 2) {
          $action = 'Regulations';
        }
        else if($row->page == 3) {
          $action = 'Directory';
        }
        else if($row->page == 4) {
          $action = 'Nirdeshika';
        }
        else if($row->page == 5) {
          $action = 'Other';
        }
        else if($row->page == 6) {
          $action = 'Download';
        }
        else if($row->page == 7) {
          $action = 'Yearly Budget';
        }
        else if($row->page == 8) {
          $action = 'Red Book';
        }
        else if($row->page == 9) {
          $action = 'Bid';
        }
        else if($row->page == 10) {
          $action = 'Economic Survey';
        }
        else if($row->page == 11) {
          $action = 'Reports related to Rights to Information';
        }
        else{
          $action = 'Medium Term Expenditure Framework';
        }
       
         return $action;

    })
    
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.document.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.document.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.document.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.document.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['type','link','action','is_active','created_at'])
    ->make(true);

  }
}
