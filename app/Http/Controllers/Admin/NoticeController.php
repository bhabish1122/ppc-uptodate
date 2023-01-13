<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use App\Notice;
use File;
use Auth;
use Image;
use App\Config;
use DataTables;

class NoticeController extends Controller
{
  public function index(Request $request){
   
    return view('admin.notice.index');
  
  }

  public function create()
  {
      return view('admin.notice.create');
  }

  public function store(Request $request)
  {   
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999);
    $this->validate($request, [
      'title' => 'required',
      'page' => 'required',
    ]);

    // dd($request['is_top'],$request['is_pop']);
    if($request['is_top'] == 'null'){
      $request['is_top'] = 0;
    }
    elseif($request['is_top'] == '1'){
      $request['is_top'] = 1;
    }
    else{
      $request['is_top'] = 0;
    }

    if($request['status'] == 'null'){
      $request['status'] = 0;
    }
    elseif($request['status'] == '1'){
      $request['status'] = 1;
    }
    else{
      $request['status'] = 0;
    }

    if($request['is_pop'] == 'null'){
      $request['is_pop'] = 0;
    }
    elseif($request['is_pop'] == '1'){
      $request['is_pop'] = 1;
    }
    else{
      $request['is_pop'] = 0;
    }

    // if($request['is_top'] == 'false'){
    //   $request['is_top'] = 0;
    // }
    // elseif($request['is_top'] == 'true'){
    //   $request['is_top'] = 1;
    // }
    // else{
    //   $request['is_top'] = 0;
    // }

    // if($request['status'] == 'false'){
    //   $request['status'] = 0;
    // }
    // elseif($request['status'] == 'true'){
    //   $request['status'] = 1;
    // }
    // else{
    //   $request['status'] = 0;
    // }

    // if($request['is_pop'] == 'false'){
    //   $request['is_pop'] = 0;
    // }
    // elseif($request['is_pop'] == 'true'){
    //   $request['is_pop'] = 1;
    // }
    // else{
    //   $request['is_pop'] = 0;
    // }



    // dd($request['is_top'],$request['is_pop']);
    $name = Null;
    $name_enc = Null;
    $exts = Null;
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt,jpg,jpeg',
      ]);
      $file = $request->file('photo');
      $destinationPath = 'files/notice';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $exts = $file->getClientOriginalExtension();
      $file->move($destinationPath, $name_enc);
    }
    $notice = Notice::create([
      'contract_id' => $request['contract_id'],
      'title' => $request['title'],
      'slug' => $request['slug'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $exts,
      'date' => $request['date'] ? $request['date'] : date('Y-m-d'),
      'date_np' => $this->helper->date_np_con(),
      'remark' => $request['remark'],
      'description' => $request['description'],
      'page' => $request['page'],
      'contract_id' => $request['contract_id'],
      'is_top' => $request['is_top'],
      'is_pop' => $request['is_pop'],
      'status' => $request['status'],
      'duration' => $request['duration'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Notice Created!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','general-notice','procurement-notice','','','','covid-notice-board'];
    // $date_np = $this->helper->date_np_con();
    // $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/notice',[
    //     'json' => array(
    //         'id' => $notice->id,
    //         'title' => $notice->title,
    //         'route_url' => route('web.notice.show',[$pages[$notice->page],$notice->slug]),
    //         'date_np' => $date_np,
    //         'api_key' => $pages[$notice->page],
    //         'server_id' => env('WEB_API_KEY'),
    //         'page' => $notice->page,
    //         'is_scroll' => $notice->is_top,
    //         'ministry' => $ministry,
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //     ]);

    return redirect()->route('admin.notice.index')->with($pass);

  }

  public function edit($id){
    $notices = Notice::findOrFail($id);
    return view('admin.notice.edit',compact('notices'));
  }

  public function update(Request $request, $id)
  {   
    // dd($request);
    $this->validate($request, [
      'title' => 'required',
      'page' => 'required',
    ]);
    $user = Notice::findOrFail($id);
    $name = Notice::where('id',$id)->value('image');
    $name_enc = Notice::where('id',$id)->value('image_enc');
    $name_ext = Notice::where('id',$id)->value('ext');
    if($request->hasFile('photo')){
      $path_old_file = "/files/notice/".$name_enc;
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt,jpg,jpeg',
      ]);
      $file = $request->file('photo');
      $destinationPath = 'files/notice';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $file->move($destinationPath, $name_enc);
      $name_ext = $file->getClientOriginalExtension();
      if(file_exists("/files/notice/".$name_enc)){
        unlink($path_old_file);
      }
    }
    // dd($request);

    if($request['is_top'] == 'null'){
      $request['is_top'] = 0;
    }
    elseif($request['is_top'] == '1'){
      $request['is_top'] = 1;
    }
    else{
      $request['is_top'] = 0;
    }

    if($request['status'] == 'null'){
      $request['status'] = 0;
    }
    elseif($request['status'] == '1'){
      $request['status'] = 1;
    }
    else{
      $request['status'] = 0;
    }

    if($request['is_pop'] == 'null'){
      $request['is_pop'] = 0;
    }
    elseif($request['is_pop'] == '1'){
      $request['is_pop'] = 1;
    }
    else{
      $request['is_pop'] = 0;
    }

    // if($request['is_top'] == 'false'){
    //   $request['is_top'] = 0;
    // }
    // elseif($request['is_top'] == 'true'){
    //   $request['is_top'] = 1;
    // }

    // if($request['status'] == 'false'){
    //   $request['status'] = 0;
    // }
    // elseif($request['status'] == 'true'){
    //   $request['status'] = 1;
    // }

    // if($request['is_pop'] == 'false'){
    //   $request['is_pop'] = 0;
    // }
    // elseif($request['is_pop'] == 'true'){
    //   $request['is_pop'] = 1;
    // }

    $user->update([
      'contract_id' => $request['contract_id'],
      'title' => $request['title'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $name_ext,
      'date' => $request['date'] ? $request['date'] : date('Y-m-d'),
      'remark' => $request['remark'],
      'description' => $request['description'],
      'page' => $request['page'],
      'contract_id' => $request['contract_id'],
      'is_top' => $request['is_top'],
      'is_pop' => $request['is_pop'],
      'status' => $request['status'],
      'duration' => $request['duration'],
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Notice Updated!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','general-notice','procurement-notice','','','','covid-notice-board'];
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/notice/update',[
    //     'json' => array(
    //         'id' => $user->id,
    //         'title' => $user->title,
    //         'route_url' => route('web.notice.show',[$pages[$user->page],$user->slug]),
    //         'api_key' => $pages[$user->page],
    //         'page' => $user->page,
    //         'server_id' => env('WEB_API_KEY'),
    //         'is_scroll' => $user->is_top,
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //     ]);

    return redirect()->route('admin.notice.index')->with($pass);
  }

  public function destroy($id){
    $data_delete = Notice::findOrFail($id);
    if ($data_delete->image_enc && file_exists('files/notice/'.$data_delete->image_enc)) {
      unlink('files/notice/'.$data_delete->image_enc);
    }
    if($data_delete->delete()){
      $pass = array(
          'message' => 'Config Deleted!',
          'alert-type' => 'success'
      );
      // // api section
      // $client = new \GuzzleHttp\Client();
      // $res = $client->request('GET', 'https://p1.gov.np/api/notice',[
      //     'json' => array(
      //         'id' => $id,
      //         'server_id' => env('WEB_API_KEY'),
      //     )
      //   ]);

    }else{
      $pass = array(
          'message' => 'Config could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return response()->json($pass);
    return redirect()->route('admin.notice.index')->with($pass);
  }

  public function status($id, $avi){
    $user = Notice::findOrFail($id);
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
    // $res = $client->request('GET', 'https://p1.gov.np/api/notice/active',[
    //     'json' => array(
    //         'id' => $id,
    //         'avi' => $avi,
    //         'server_id' => env('WEB_API_KEY'),
    //     )
    //     ]);
    
    return back()->with($notification)->withInput();
  }

  public function getNoticeList(Request $request)
  {
    $notice_idSearch = $request->notice_idSearch;
    $search = $request->search;

    $data = Notice::orderBy('id','DESC');

    if(!empty($request->notice_idSearch))
    {  
      $notice_id = $request->notice_idSearch;          
      $data = $data->where('page', 'LIKE',"%{$notice_id}%");
    }


    $data = $data->get();

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('link', function($row){
      if($row->image_enc){
        $url=asset("files/notice/$row->image_enc"); 
        $action = '<a href="'.$url.'" class="btn btn-sm btn-outline-danger" target="_blank"  data-toggle="tooltip" data-placement="top" >'.$row->ext.'</a>';
      }
      else{
        $action = '';
      }

      return $action;

    })
    ->addColumn('description', function($row){
      return strip_tags($row->description);
    })
    ->addColumn('remark', function($row){
      return strip_tags($row->remark);
    })
    ->addColumn('page', function($row){
      if ($row->page == 1) {
        $page = 'General Notice';
      }
      else if($row->page == 2){
        $page = 'Procurement Notice';

      }
      else if($row->page == 3){
        $page = 'Posting Notice';

      }
      else if($row->page == 4){
        $page = 'Publication';

      }
      else if($row->page == 5){
        $page = 'Circular';

      }
      else{
        $page = 'Bulletin Notice Board';
      }
      return $page;

    })

    ->addColumn('is_active', function($row){

      $action = '<a href="'.route('admin.notice.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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

      $action = '<a href="'.route('admin.notice.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> |
      <a href="#" data-url="'.route('admin.notice.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.notice.destroy', $row->id).'"></i></a>


      ';
      return $action;

    })
    ->rawColumns(['link','action','is_active','created_at'])
    ->make(true);
  }



}
