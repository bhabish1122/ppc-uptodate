<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\ListOfProject;
use Auth;


class ListOfProjectController extends Controller
{
  public function index(Request $request){
    $posts = ListOfProject::orderBy('id','DESC');
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
      'list_of_projects' => $posts
    ];
    return response()->json($response);
  }

  public function store(Request $request)
  {  
    $request['slug'] = $this->helper->slug_converter($request['title']).'-'.$this->helper->date_np_con(); 
    $this->validate($request, [
      'title' => 'required',
      'title_np' => 'required',

    ]);

    ListOfProject::create([
      'title' => $request['title'],
      'title_np' => $request['title_np'],
      'slug' => $request['slug'],
      'description' => $request['description'],
      'link' => $request['link'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);
    return ['message' => $request['title'].' Link Created'];
  }


  public function edit($id){
    $edit_data = ListOfProject::findOrFail($id);
    return response()->json([
      'edit_data'=>$edit_data
    ],200);
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'title_np' => 'required',
    ]);
    $data_update = ListOfProject::findOrFail($id);

    $data_update->update([
      'title' => $request['title'],
      'title_np' => $request['title_np'],
      'description' => $request['description'],
      'link' => $request['link'],
      'updated_by' => Auth::user()->id,
    ]);
    return ['message' => 'ListOfProject Updated'];
  }

  public function destroy($id){
    $data_destroy = ListOfProject::findOrFail($id);
    $data_destroy->delete();
    return ['message'=>'ok'];
  }

  public function status($id, $avi){
    $data_status = ListOfProject::findOrFail($id);
    $data_status->is_active = !$avi;
    $data_status->save();
  }
}
