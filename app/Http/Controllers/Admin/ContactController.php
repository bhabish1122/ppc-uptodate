<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper\Helper;
use App\Contact;
use Auth;

class ContactController extends Controller
{
  public function index(Request $request){
    $posts = Contact::orderBy('id','DESC');
    if(empty($request->search))
    {            
      $posts = $posts;
    }
    else{
      $search = $request->search;
      $posts = $posts->where('email', 'LIKE',"%{$search}%");
    }
    
    $contacts = $posts->paginate(15);
    return view('admin.contact.index',compact('contacts'));
  }

  public function create()
  {
      return view('admin.contact.create');
  }

  public function store(Request $request)
  {  
    $this->validate($request, [
      'address' => 'required',
      'address_en' => 'required',
      'phone_en' => 'required',
      'phone' => 'required',
      'email' => 'required',
    ]);

    Contact::create([
      'address' => $request['address'],
      'address_en' => $request['address_en'],
      'phone_en' => $request['phone_en'],
      'phone' => $request['phone'],
      'email' => $request['email'],
      'facebook' => $request['facebook'],
      'twitter' => $request['twitter'],
      'googleplus' => $request['googleplus'],
      'youtube' => $request['youtube'],
      'map' => $request['map'],
      'facebook_embeded' => $request['facebook_embeded'],
      'twitter_embeded' => $request['twitter_embeded'],
      'is_active' => '1',
      'created_at_np' => $this->helper->date_np_con()." ".date("H:i:s"),
      'created_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => $request['email'].' Link Created',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.contact.index')->with($pass);
  }


  public function edit($id){
    $contacts = Contact::findOrFail($id);
    return view('admin.contact.edit', compact('contacts'));
  }

  public function update(Request $request, $id)
  {   
    $this->validate($request, [
      'address' => 'required',
      'address_en' => 'required',
      'phone_en' => 'required',
      'phone' => 'required',
      'email' => 'required',
    ]);
    $data_update = Contact::findOrFail($id);

    $data_update->update([
      'address' => $request['address'],
      'address_en' => $request['address_en'],
      'phone_en' => $request['phone_en'],
      'phone' => $request['phone'],
      'email' => $request['email'],
      'facebook' => $request['facebook'],
      'twitter' => $request['twitter'],
      'googleplus' => $request['googleplus'],
      'youtube' => $request['youtube'],
      'map' => $request['map'],
      'facebook_embeded' => $request['facebook_embeded'],
      'twitter_embeded' => $request['twitter_embeded'],
      'updated_by' => Auth::user()->id,
    ]);

    $pass = array(
        'message' => 'Contact Updated!',
        'alert-type' => 'success'
    );
    return redirect()->route('admin.contact.index')->with($pass);
  }

  public function destroy($id){
    $data_destroy = Contact::findOrFail($id);
    // $data_destroy->delete();
    if($data_destroy->delete()){
      $pass = array(
          'message' => 'Contact Deleted!',
          'alert-type' => 'success'
      );
    }else{
      $pass = array(
          'message' => 'Contact could not be Deleted!',
          'alert-type' => 'error'
      );

    }
    return response()->json($pass);
    return redirect()->route('admin.contact.index')->with($pass);
  }

  public function status($id, $avi){
    $user = Contact::findOrFail($id);
    if($avi == 0){
      $user->is_active = 1;
      $notification = array(
        'message' => $user->email.' is Active!',
        'alert-type' => 'success'
      );
    }
    else {
      $user->is_active = 0;
      $notification = array(
        'message' => $user->email.' is inactive!',
        'alert-type' => 'error'
      );
    }

    $user->save();
    return back()->with($notification)->withInput();

  }
}
