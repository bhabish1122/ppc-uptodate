<?php

namespace App\Http\Controllers\Web;

use App\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;

class FormController extends Controller
{
    public function index()
    {
        // for all page
        $notice_top = $this->allNotice(6)['notice'];
        $usefullinks = $this->allUsefulLink(5)['usefullink'];
        $quickmenus = $this->allQuickMenu(5)['quickmenu'];
        $contacts = $this->allContact(1)['contact'];

        $page_title = __('lang.forms');
        return view('web.form.index', compact(['notice_top','usefullinks','quickmenus','contacts','page_title']));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'form_type' => 'required',
          'name' => 'required',
          'description' => 'required',
          // 'phone' => 'required|min:10',
        ]);

        $data_store = Form::create([
                            'form_type' => $request->form_type,
                            'name' => $request->name,
                            'description' => $request->description,
                            'phone' => $request->phone,
                            'email' => $request->email,
                        ]);
            
            $notification = array(
                'message' => 'Form submit successfully! Thank you.',
                'alert-type' => 'success'
            );

        return Redirect::route('web.form.index')->with($notification);
    }
}
