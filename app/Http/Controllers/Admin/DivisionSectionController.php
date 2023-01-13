<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;

use File;
use Auth;
use Image;
use App\DivisionSection;
use App\Config;
use DataTables;

class DivisionSectionController extends Controller
{
  public function index(Request $request){
    return view('admin.division_section.index');
  }


  public function create()
  {
      return view('admin.division_section.create');
  }

  public function store(Request $request)
  {  
    $request['slug'] = $this->helper->slug_converter($request['name']).'-'.$this->helper->date_np_con().rand(); 
    $this->validate($request, [
      'office' => 'required',
      'name' => 'required',
      'address' => 'required',
      'contact_no' => 'required',
      'photo' => 'required',
    //   'designation' => 'required',
    //   'photo' => 'required|mimes:jpg,jpeg,png|max:5024',
      'description' => 'required',
      'division_work' => 'required',
      // 'page' => 'required',
    ]);

    if($request->hasFile('photo')){
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png|max:5024',
        ]);
        $file = $request->file('photo');
        $destinationPath = 'image/division_section';
        $destinationPath1 = 'image/division_section/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
        $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();
        $destinationThumbPath = 'image/division_section/thumbnail/'.$name_enc;
        $ext = $file->getClientOriginalExtension();
        Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
        $file->move($destinationPath, $name_enc);
    }
    else{
        $name = NULL;
        $name_enc = NULL;
        $ext = NULL;
    }
    $division = DivisionSection::create([
      'title' => $request['office'],
      // 'office' => $request['office'],
      'slug' => $request['slug'],
      'name' => $request['name'],
      'address' => $request['address'],
      'contact_no' => $request['contact_no'],
      'email' => $request['email'],
      'designation' => $request['designation'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $ext,
      'description' => $request['description'],
      'division_work' => $request['division_work'],
      'page' => '1',
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => ' DivisionSection Created',
        'alert-type' => 'success'
    );
     // api section
    // $date_np = $this->helper->date_np_con();
    // $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/division',[
    //     'json' => array(
    //         'id' => $division->id, // remote id
    //         'server_id' => env('WEB_API_KEY'), // server
    //         'office' => $division->office, // bibhag
    //         'address' => $division->address, // address
    //         'designation' => $division->designation, // designation
    //         'name' => $division->name, // title
    //         'contact_no' => $division->contact_no, // contact
    //         'email' => $division->email, // email
    //         'route_url' => route('web.about.office.show',[$division->id]), // url
    //         'date_np' => $date_np, // date np
    //         'ministry' => $ministry, // ministry
    //         'api_key' => 'office', // api key
    //         'is_active' => $division->is_active, // active
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //   ]);

    return redirect()->route('admin.division_section.index')->with($pass);
  }

  public function edit($id){
    $division_sections = DivisionSection::findOrFail($id);
    return view('admin.division_section.edit', compact('division_sections'));
  
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'office' => 'required',
      'name' => 'required',
      'address' => 'required',
      'contact_no' => 'required',
    ]);
    $user = DivisionSection::findOrFail($id);
    $name = DivisionSection::where('id',$id)->value('image');
    $name_enc = DivisionSection::where('id',$id)->value('image_enc');
    $name_ext = DivisionSection::where('id',$id)->value('ext');
    if($request->hasFile('photo')){
      $this->validate($request, [
        'photo' => 'required|mimes:jpg,jpeg,png|max:5024',
      ]);
      $path_old_file = "image/division_section/".$name_enc;
      $path_old_file_thumb = "image/division_section/thumbnail/".$name_enc;

      $file = $request->file('photo');
      $destinationPath = 'image/division_section';
      $destinationPath1 = 'image/division_section/thumbnail';
        if (!is_dir($destinationPath)) {
          static::createPathDiretory($destinationPath);
        }
        if (!is_dir($destinationPath1)) {
          static::createPathDiretory($destinationPath1);
        }
      $name_enc = date('YmdHis') . "." . $file->getClientOriginalExtension();
      $name = $file->getClientOriginalName();
      $destinationThumbPath = 'image/division_section/thumbnail/'.$name_enc;
      Image::make($file->getRealPath())->resize(150, 150)->save($destinationThumbPath);
      $file->move($destinationPath, $name_enc);
      $name_ext = $file->getClientOriginalExtension();
      // unlink($path_old_file);
      // unlink($path_old_file_thumb);
    }
    $user->update([
      // 'page' => $request['page'],
      'name' => $request['name'],
      'designation' => $request['designation'],
      'image' => $name,
      'image_enc' => $name_enc,
      'ext' => $name_ext,
      'title' => $request['title'],
      'address' => $request['address'],
      'contact_no' => $request['contact_no'],
      'email' => $request['email'],
      'description' => $request['description'],
      'division_work' => $request['division_work'],
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'DivisionSection Updated!',
        'alert-type' => 'success'
    );
    // api section
    // $date_np = $this->helper->date_np_con();
    // $ministry = Config::orderBy('id', 'desc')->first()->office_np;
    // $client = new \GuzzleHttp\Client();
    // $res = $client->request('PUT', 'https://p1.gov.np/api/division/update',[
    //     'json' => array(
    //         'id' => $user->id, // remote id
    //         'server_id' => env('WEB_API_KEY'), // server
    //         'office' => $user->office, // bibhag
    //         'address' => $user->address, // address
    //         'designation' => $user->designation, // designation
    //         'name' => $user->name, // title
    //         'contact_no' => $user->contact_no, // contact
    //         'email' => $user->email, // email
    //         'route_url' => route('web.about.office.show',[$user->id]), // url
    //         'date_np' => $date_np, // date np
    //         'ministry' => $ministry, // ministry
    //         'api_key' => 'office', // api key
    //         'is_active' => $user->is_active, // active
    //         'token_id' => sha1(env('WEB_API_KEY')."p1govnp"),
    //     )
    //   ]);

    return redirect()->route('admin.division_section.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = DivisionSection::findOrFail($id);
    // if(file_exists('image/division_section/'.$usertype->image_enc)){
    //   unlink('image/division_section/'.$usertype->image_enc);
    //   unlink('image/division_section/thumbnail/'.$usertype->image_enc);
    // }
    if($data_destroy->delete()){
      // api section
      // $client = new \GuzzleHttp\Client();
      // $res = $client->request('GET', 'https://p1.gov.np/api/division',[
      //   'json' => array(
      //       'id' => $id,
      //       'server_id' => env('WEB_API_KEY'),
      //   )
      //   ]);

      $pass = array(
          'message' => 'DivisionSection Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'DivisionSection could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    
    return redirect()->route('admin.division_section.index')->with($pass);
 
  }

  public function status($id, $avi){
    $user = DivisionSection::findOrFail($id);
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
    // $res = $client->request('GET', 'https://p1.gov.np/api/division/active',[
    //     'json' => array(
    //         'id' => $id,
    //         'avi' => $avi,
    //         'server_id' => env('WEB_API_KEY'),
    //     )
    //     ]);
    
    return back()->with($notification)->withInput();


  }

  public function getDivisionSectionList(Request $request)
  {

    $data = DivisionSection::orderBy('id','DESC');
    $data = $data->get();            

    return Datatables::of($data)
    ->addIndexColumn()
    
    ->addColumn('is_active', function($row){

        $action = '<a href="'.route('admin.division_section.status',[$row->id,$row->is_active]).'" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" >';

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
    ->addColumn('image', function($row){
      $url=asset("image/division_section/$row->image_enc"); 
      return '<img src='.$url.' border="0" width="40" class="img-rounded" align="center" />';

    })
    ->addColumn('created_at', function($row){
      $name = $row->created_at->format('H:i:s').' <span class="badge badge-success ">'.$row->created_at->format('Y/m/d').'</span>';
      return $name;

    })
    ->addColumn('action', function($row){
        // dd($row->id);
      $action = '<a href="'.route('admin.division_section.edit',$row->id).'" class="btn btn-sm btn-flat btn-outline-primary"><i class="fas fa-pencil-alt" title="Click to edit"></i></a> 

      <a href="#" data-url="'.route('admin.division_section.destroy', $row->id).'" class="btn btn-sm btn-outline-danger " onclick="return confirmDelete(event);"><i class="fa fa-trash" data-url="'.route('admin.division_section.destroy', $row->id).'"></i></a>
      ';
      return $action;

    })
    ->rawColumns(['image','action','is_active','created_at'])
    ->make(true);

  }
}
