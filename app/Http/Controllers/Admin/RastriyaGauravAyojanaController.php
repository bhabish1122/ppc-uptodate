<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RastriyaGauravAyojana;
use App\Helper\Helper;
use Auth;

class RastriyaGauravAyojanaController extends Controller
{
  public function index(Request $request){
    $posts = RastriyaGauravAyojana::orderBy('id','DESC');
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
      'rastriya_gaurav_ayojanas' => $posts
    ];
    return response()->json($response);
  }

  public function store(Request $request)
  {  
    $request['slug'] = $this->helper->slug_converter($request['title']); 
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);

    RastriyaGauravAyojana::create([
      'title' => $request['title'],
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
    $edit_data = RastriyaGauravAyojana::findOrFail($id);
    return response()->json([
      'edit_data'=>$edit_data
    ],200);
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'title' => 'required',
      'description' => 'required',
    ]);
    $data_update = RastriyaGauravAyojana::findOrFail($id);

    $data_update->update([
      'title' => $request['title'],
      'description' => $request['description'],
      'link' => $request['link'],
      'updated_by' => Auth::user()->id,
    ]);
    return ['message' => 'RastriyaGauravAyojana Updated'];
  }

  public function destroy($id){
    $data_destroy = RastriyaGauravAyojana::findOrFail($id);
    $data_destroy->delete();
    return ['message'=>'ok'];
  }

  public function status($id, $avi){
    $data_status = RastriyaGauravAyojana::findOrFail($id);
    $data_status->is_active = !$avi;
    $data_status->save();
  }
}
