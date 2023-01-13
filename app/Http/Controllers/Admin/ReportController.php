<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Report;
use File;
use Auth;
use Image;
use App\Config;
use DataTables;

class ReportController extends Controller
{
  public function index(Request $request){
    
    return view('admin.report.index');
  }

  public function create()
  {
      return view('admin.report.create');
  }

  public function store(Request $request)
  {  
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999); 
    $this->validate($request, [
      'page' => 'required',
      'title' => 'required',
      'description' => 'required',
    ]);
    $name = Null;
    $name_enc = Null;
    $exts = Null;
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
      ]);
      $file = $request->file('photo');
      $destinationPath = 'files/report';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $exts = $file->getClientOriginalExtension();
    // $destinationThumbPath = 'files/report/thumbnail/'.$name_enc);
    // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
    }
    $report = Report::create([
      'page' => $request['page'],
      'title' => $request['title'],
      'slug' => $request['slug'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $exts,
      'description' => $request['description'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Report Created!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','quaterly-report','yearly-report','','','','monthly-report','semi-annual-report'];
    // $date_np = $this->helper->date_np_con();
    // $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/report',[
    //     'json' => array(
    //         'id' => $report->id,
    //         'title' => $report->title,
    //         'route_url' => route('web.report.show',[$pages[$report->page],$report->slug]),
    //         'date_np' => $date_np,
    //         'api_key' => $pages[$report->page],
    //         'server_id' => env('WEB_API_KEY'),
    //         'ministry' => $ministry,
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //   ]);

    return redirect()->route('admin.report.index')->with($pass);
  }

  public function edit($id){
    $reports = Report::findOrFail($id);
    return view('admin.report.edit',compact('reports'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
      'page' => 'required',
    ]);
    $user = Report::findOrFail($id);
    $name = Report::where('id',$id)->value('image');
    $name_enc = Report::where('id',$id)->value('image_enc');
    $exts = Report::where('id',$id)->value('ext');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:pdf,xlsm,xlsx,xltx,xltm,xls,xlsxm,doc,docx,pptx,ppt',
      ]);
      $path_old_file = 'files/report/'.$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'files/report';
      if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $exts = $file->getClientOriginalExtension();
    // $destinationThumbPath = 'files/report/thumbnail/'.$name_enc);
    // Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      if(file_exists("/files/report/".$name_enc)){
        unlink($path_old_file);
      }
    }
    $user->update([
      'title' => $request['title'],
      'page' => $request['page'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $exts,
      'description' => $request['description'],
      'updated_by' => Auth::user()->id,
    ]);
    $pass = array(
        'message' => 'Report Updated!',
        'alert-type' => 'success'
    );
    // api section
    // $pages = ['','quaterly-report','yearly-report','','','','monthly-report','semi-annual-report'];
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/report/update',[
    //     'json' => array(
    //         'id' => $user->id,
    //         'title' => $user->title,
    //         'route_url' => route('web.report.show',[$pages[$user->page],$user->slug]),
    //         'api_key' => $pages[$user->page],
    //         'server_id' => env('WEB_API_KEY'),
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //     ]);

    return redirect()->route('admin.report.index')->with($pass);
    // return ['message' => 'Report Updated'];
  }

  public function destroy($id){
    $data_delete = Report::findOrFail($id);
    if($data_delete->image_enc && file_exists("/files/report/".$data_delete->image_enc)){
      unlink("/files/report/".$data_delete->image_enc);
    }
    if($data_delete->delete()){
      $pass = array(
          'message' => 'Report Deleted!',
          'alert-type' => 'success'
      );
      // // api section
      // $client = new \GuzzleHttp\Client();
      // $res = $client->request('GET', 'https://p1.gov.np/api/report',[
      //     'json' => array(
      //         'id' => $id,
      //         'server_id' => env('WEB_API_KEY'),
      //     )
      //   ]);

    }else{
      $pass = array(
          'message' => 'Report could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return response()->json($pass);
    return redirect()->route('admin.report.index')->with($pass);
  }

  public function status($id, $avi){
    $user = Report::findOrFail($id);
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
    // $res = $client->request('GET', 'https://p1.gov.np/api/report/active',[
    //     'json' => array(
    //         'id' => $id,
    //         'avi' => $avi,
    //         'server_id' => env('WEB_API_KEY'),
    //     )
    //     ]);
    
    return back()->with($notification)->withInput();
  }

  public function getReportList(Request $request)
  {

    $report_id = $request->report_id;

    $data = Report::orderBy('id','DESC');

    if(!empty($request->report_id))
    {  
      $report_id = $request->report_id;          
      $data = $data->where('page', 'LIKE',"%{$report_id}%");
    }

    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('link', function($row){
      if($row->image_enc){
        $url=asset("files/report/$row->image_enc"); 
        $action = '<a href="'.$url.'" class="btn btn-sm btn-outline-danger" target="_blank"  data-toggle="tooltip" data-placement="top" >'.$row->ext.'</a>';
      }
      else{
        $action = '';
      }
      
      return $action;

    })
    ->addColumn('image', function($row){
      $url=asset("image/report/$row->image_enc"); 
      return $row->image;

    })
    ->addColumn('page', function($row){
        if ($row->page == 1) {
          $action = 'Quaterly Progress Report';
        }
        else if($row->page == 2) {
          $action = 'Yearly Report';
        }
        else if($row->page == 6) {
          $action = 'Monthly Report';
        }
        else if($row->page == 7) {
          $action = 'Semi-annual Report';
        }
        else if($row->page == 8) {
          $action = 'Chemical inspection report';
        }
        else if($row->page == 9) {
          $action = 'Self-publishing on Right to Information';
        }
        else if($row->page == 10) {
          $action = 'Budgeted implementation action plan';
        }
        else if($row->page == 11) {
          $action = 'Performance Agreement';
        }
        else if($row->page == 12) {
          $action = 'Audit Report (Final)';
        }
        else if($row->page == 13) {
          $action = 'Internal Audit Report';
        }
        
        else{
          $action = 'Consolidated Financial Statements';
        }
       
         return $action;

    })
    
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.report.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
      $action = '<a href="'.route('admin.report.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 
      <a href="#" data-url="'.route('admin.report.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.report.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['link','image','action','is_active','created_at'])
    ->make(true);

  }
}
