<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\CorePerson;
use File;
use Auth;
use Image;
use App\Config;
use DataTables;

class CorePersonController extends Controller
{
  public function index(Request $request){
    
    return view('admin.core_person.index');
  }

  public function create()
  {
      return view('admin.core_person.create');
  }



  public function store(Request $request)
  {  
    // dd($request);
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999); 
    $this->validate($request, [
      'name' => 'required',
      'name_en' => 'required',
      'designation_en' => 'required',
      'designation' => 'required',
    ]);
    // is_front
    // 0 for none
    // 1 mantri
    // 2 sachib
    // 3 prabakta
    // 4 suchana adhikari
    // 5 gunaso sunne officer 
    if($request['is_m_v'] == 'null'){
      $request['is_m_v'] = 0;
    }
    elseif($request['is_m_v'] == '1'){
      $request['is_m_v'] = 1;
    }
    else{
      $request['is_m_v'] = 0;
    }
    // dd($request['is_employee']);
    if($request['is_employee'] == 'null'){
      $request['is_employee'] = 0;
    }
    elseif($request['is_employee'] == '1'){
      $request['is_employee'] = 1;
    }
    else{
      $request['is_employee'] = 0;
    }
    // dd($request['is_employee']);

    if($request['is_sachibalaya'] == 'null'){
      $request['is_sachibalaya'] = 0;
    }
    elseif($request['is_sachibalaya'] == '1'){
      $request['is_sachibalaya'] = 1;
    }
    else{
      $request['is_sachibalaya'] = 0;
    }
    
    if($request['status'] == null){
      $request['status'] = 0;
    }

    // dd($request['is_m_v'],$request['is_employee'],$request['is_sachibalaya']);
    if($request->hasFile('photo')){
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png|max:5024',
        ]);
        $file = $request->file('photo');
        $destinationPath = 'image/core_person';
        $destinationPath1 = 'image/core_person/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
        $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $destinationThumbPath = 'image/core_person/thumbnail/'.$name_enc;
        Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
        $file->move($destinationPath, $name_enc);
    }

    $core = CorePerson::create([
      'name' => $request['name'],
      'name_en' => $request['name_en'],
      'designation_en' => $request['designation_en'],
      'slug' => $request['slug'],
      'designation' => $request['designation'],
      'department' => $request['department'],
      'facebook' => $request['facebook'],
      'twitter' => $request['twitter'],
      'youtube' => $request['youtube'],
      'image' => $request->hasFile('photo') ? $name : Null,
      'image_enc' => $request->hasFile('photo') ? $name_enc : Null,
      'division' => 'na',
      'phone' => $request['phone'],
      'fax' => $request['fax'],
      'email' => $request['email'],
      'description' => $request['description'],
      'status' => $request['status'],
      'is_division_page' => 1,//vue ma default 1 pathako thiyo tesaaile maile ni pathaideko
      'sort_id' => $request['sort_id'],
      
      'is_front' => $request['is_front'],
      'is_m_v' => $request['is_m_v'],
      'is_employee' => $request['is_employee'],
      'is_sachibalaya' => $request['is_sachibalaya'],
      'from_date' => $request['from_date'],
      // 'from_date_np' => $this->helper->date_np_con_parm($request['from_date']),
      'from_date_np' => $this->helper->date_np_con(),
      'to_date' => $request['to_date'],
      // 'to_date_np' => $request['to_date'] ? $this->helper->date_np_con_parm($request['to_date']) : NULL,
      'to_date_np' => $this->helper->date_np_con(),
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'CorePerson Created!',
        'alert-type' => 'success'
    );
     // api section
    // if($request['status'] == '1'){
    //   if(($request['is_front'] != '0') || ($request['is_front'] != '2'  )){
    //     if($request['is_front'] == '1'){
    //       $is_front = 1;
    //     }
    //     else{
    //       $is_front = 0;
    //     }
    //     if(($request['is_front'] == '3') || ($request['is_front'] == '4')){
    //       $is_start = 1;
    //     }
    //     else{
    //       $is_start = 0;
    //     }
    //     $pages = ['','general-notice','procurement-notice','','','','covid-notice-board'];
    //     $date_np = $this->helper->date_np_con();
    //     $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    //     $client = new \GuzzleHttp\Client();
    //     $res = $client->request('PUT', 'https://p1.gov.np/api/coreperson',[
    //         'json' => array(
    //             'id' => $core->id,
    //             'name' => $core->name,
    //             'designation' => $core->designation,
    //             'phone' => $core->phone,
    //             'route_url' => route('web.about.list-of-director-generals.show',$core->id),
    //             'is_top' => $is_front,
    //             'is_start' => $is_start,
    //             'image' => 'https://'.env('WEB_API_KEY').'.p1.gov.np/image/core_person/'.$core->image_enc,
    //             'date_np' => $date_np,
    //             'server_id' => env('WEB_API_KEY'),
    //             'ministry' => $ministry,
    //             'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //         )
    //         ]);
    //   }
    // }

    return redirect()->route('admin.core_person.index')->with($pass);

  }

  public function edit($id){
    // var_dump($id); die();
    $core_persons = CorePerson::findOrFail($id);
    return view('admin.core_person.edit',compact('core_persons'));
    // return response()->json([
    //   'categories'=>$categories
    // ],200);
  }

  public function update(Request $request, $id)
  {   
    // dd($request);
    $this->validate($request, [
      'name' => 'required',
      'name_en' => 'required',
      'designation_en' => 'required',
      'designation' => 'required',
      // 'division' => 'required',
      //'phone' => 'required',
      // 'email' => 'required',
      //'from_date' => 'required',
    ]);
    $user = CorePerson::findOrFail($id);
    $name = CorePerson::where('id',$id)->value('image');
    $name_enc = CorePerson::where('id',$id)->value('image_enc');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:jpg,jpeg,png|max:5024',
      ]);
      $path_old_file = "image/core_person/".$name_enc;
      $path_old_file_thumb = "image/core_person/thumbnail/".$name_enc;
        if ($name_enc && file_exists($path_old_file)) {
            unlink($path_old_file);
            unlink($path_old_file_thumb);
          }
      $file = $request->file('photo');
      $destinationPath = 'image/core_person';
      $destinationPath1 = 'image/core_person/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/core_person/thumbnail/'.$name_enc;
      Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      
    }
    $request['slug'] = $this->helper->date_np_con()."-".rand(10000,99999);
        // is_front
    // 0 for none
    // 1 minister
    // 2 Secretary
    // 3 Nodal Person
    // 4 Information Officer 
    
    if($request['status'] == null){
      $request['status'] = 0;
    }
    $user->update([
      'name' => $request['name'],
      'name_en' => $request['name_en'],
      'designation_en' => $request['designation_en'],
      'slug' => $request['slug'],
      'designation' => $request['designation'],
      // 'department' => $request['department'],
      'facebook' => $request['facebook'],
      'twitter' => $request['twitter'],
      'youtube' => $request['youtube'],
      'image' => $name,
      'image_enc' => $name_enc,
      // 'division' => $request['division'],
      'phone' => $request['phone'],
      'fax' => $request['fax'],
      'email' => $request['email'],
      'description' => $request['description'],
      'status' => $request['status'],
      'is_division_page' => 1, //edit ma ni default tarika le pathako xa form bata

      'sort_id' => $request['sort_id'],
      'is_front' => $request['is_front'],
      'is_m_v' => isset($request['is_m_v']) ? $request['is_m_v']=='1' || $request['is_m_v']=='1' ? '1' : '0' : '0',
      'is_employee' => isset($request['is_employee']) ? $request['is_employee']=='1' || $request['is_employee']=='1' ? '1' : '0' : '0',
      'is_sachibalaya' => isset($request['is_sachibalaya']) ? $request['is_sachibalaya']=='1' || $request['is_sachibalaya']=='1' ? '1' : '0' : '0',

      // 'is_m_v' => isset($request['is_m_v']) ? $request['is_m_v']=='1' || $request['is_m_v']=='true' ? '1' : '0' : '0',
      // 'is_employee' => isset($request['is_employee']) ? $request['is_employee']=='1' || $request['is_employee']=='true' ? '1' : '0' : '0',
      // 'is_sachibalaya' => isset($request['is_sachibalaya']) ? $request['is_sachibalaya']=='1' || $request['is_sachibalaya']=='true' ? '1' : '0' : '0',

      'from_date' => $request['from_date'],

      'from_date_np' => $this->helper->date_np_con(),
      'to_date' => $request['to_date'],
      'to_date_np' => $this->helper->date_np_con(),
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Core Person Updated!',
        'alert-type' => 'success'
    );
    // api section
    // if(($request['status'] == '1')){
    //   if(($request['is_front'] != '0') || ($request['is_front'] != '2')){
    //     if($request['is_front'] == '1'){
    //       $is_front = 1;
    //     }
    //     else{
    //       $is_front = 0;
    //     }
    //     if(($request['is_front'] == '3') || ($request['is_front'] == '4')){
    //       $is_start = 1;
    //     }
    //     else{
    //       $is_start = 0;
    //     }
    //     // return "w";
    //     $pages = ['','general-notice','procurement-notice','','','','covid-notice-board'];
    //     $date_np = $this->helper->date_np_con();
    //     $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    //     $client = new \GuzzleHttp\Client();
    //     $res = $client->request('PUT', 'https://p1.gov.np/api/coreperson/update',[
    //       'json' => array(
    //           'id' => $user->id,
    //           'name' => $user->name,
    //           'designation' => $user->designation,
    //           'phone' => $user->phone,
    //           'route_url' => route('web.about.list-of-director-generals.show',$user->id),
    //           'is_top' => $is_front,
    //           'is_start' => $is_start,
    //           'image' => 'https://'.env('WEB_API_KEY').'.p1.gov.np/image/core_person/'.$user->image_enc,
    //           'date_np' => $date_np,
    //           'server_id' => env('WEB_API_KEY'),
    //           'ministry' => $ministry,
    //           'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //       )
    //       ]);
    //       $client = new \GuzzleHttp\Client();
    //       $res = $client->request('GET', 'https://p1.gov.np/api/coreperson/active',[
    //           'json' => array(
    //               'id' => $user->id,
    //               'avi' => 1,
    //               'server_id' => env('WEB_API_KEY'),
    //           )
    //       ]);
    //   }else{
    //     // return $user->id;
    //     $client = new \GuzzleHttp\Client();
    //     $res = $client->request('GET', 'https://p1.gov.np/api/coreperson/active',[
    //         'json' => array(
    //             'id' => $user->id,
    //             'avi' => 0,
    //             'server_id' => env('WEB_API_KEY'),
    //         )
    //       ]);
    //   }
    // }else{
    //   // return $user->id;
    //   $client = new \GuzzleHttp\Client();
    //   $res = $client->request('GET', 'https://p1.gov.np/api/coreperson/active',[
    //       'json' => array(
    //           'id' => $user->id,
    //           'avi' => 1,
    //           'server_id' => env('WEB_API_KEY'),
    //       )
    //     ]);
    // }


    return redirect()->route('admin.core_person.index')->with($pass);

    // return ['message' => 'CorePerson Updated'];
  }

  public function destroy($id){
    // return "jnijn";
    $usertype = CorePerson::findOrFail($id);
    if ($usertype->image_enc && file_exists('image/core_person/'.$usertype->image_enc)) {
      @unlink('image/core_person/'.$usertype->image_enc);
      @unlink('image/core_person/thumbnail/'.$usertype->image_enc);
    }

    if($usertype->delete()){
      // api section
      if(($usertype->is_front != '0') || ($usertype->is_front != '2')){
        // $client = new \GuzzleHttp\Client();
        // $res = $client->request('GET', 'https://p1.gov.np/api/coreperson',[
        //   'json' => array(
        //       'id' => $id,
        //       'server_id' => env('WEB_API_KEY'),
        //   )
        //   ]);
        }
        
      $pass = array(
          'message' => 'CorePerson Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'CorePerson could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return response()->json($pass);
    return redirect()->route('admin.core_person.index')->with($pass);
  }

  public function status($id, $avi){
    $user = CorePerson::findOrFail($id);
    // $user->is_active = !$avi;
    // $user->save();

    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => $user->name.' is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => $user->name.' is inactive!',
        'alert-type' => 'error'
      );
    }

    $user->save();
    // api section
    // if(($user->is_front != '0') || ($user->is_front != '2')){
    //   $client = new \GuzzleHttp\Client();
    //   $res = $client->request('GET', 'https://p1.gov.np/api/coreperson/active',[
    //       'json' => array(
    //           'id' => $id,
    //           'avi' => $avi,
    //           'server_id' => env('WEB_API_KEY'),
    //       )
    //       ]);
    // }

    return back()->with($notification)->withInput();
  }

  public function show($id){
    $user = CorePerson::findOrFail($id);
    $user->is_active = !$avi;
    $user->save();
  }

  public function getCorePersonList(Request $request)
  {

    $search = $request->search;

    $data = CorePerson::orderBy('id','DESC');
    $data = $data->get();

    return Datatables::of($data)
    ->addIndexColumn()
    ->addColumn('image', function($row){
      $url=asset("image/core_person/$row->image_enc"); 
      return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';

    })
    ->addColumn('status', function($row){
        if ($row->status == 0) {
          $action = '-';
        }
        else if($row->status == 1){
          $action = 'Current Working';
        }
        else if($row->status == 2){
          $action = 'Retired';
        }
        else if($row->status == 3){
          $action = 'Transfered';
        }
        else{
          $action = 'Other';
        }

         return $action;

    })
    
    ->addColumn('is_employee', function($row){
        if ($row->is_employee == 1) {
          $action = 'Yes';
        }
        else{
          $action = 'No';
        }
         return $action;

    })
    ->addColumn('is_sachibalaya', function($row){
        if ($row->is_sachibalaya == 1) {
          $action = 'Yes';
        }
        else{
          $action = 'No';
        }
         return $action;

    })
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.core_person.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

        if ($row->is_active == 1) {
          $action = $action.'<i class="fa fa-check" title="Click to unpublish"></i>
            </a>';
        } else {
          $action = $action.'<i class="fa fa-times text-danger" title="Click to publish"></i>
            </a>';
        }
        return $action;

    })
    ->addColumn('created_at', function($row){
     $name = $row->created_at->format("D M j Y") .' <span class="badge badge-success ">'.$row->created_at->diffForHumans().'</span>';
     return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.core_person.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 

      <a href="#" data-url="'.route('admin.core_person.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.core_person.destroy', $row->id).'"></i></a>

      ';
      return $action;

    })
    ->rawColumns(['image','action','is_active','created_at'])
    ->make(true);

    

  }
}
