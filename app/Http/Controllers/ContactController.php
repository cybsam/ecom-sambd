<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Carbon\Carbon;


class ContactController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    

    
    function contactAdminview(){
    	$contact_db = Contact::latest()->paginate(5);
    	return view('admin/contact/index', compact('contact_db'));
    }

    function contactAdminviewSingle($contact_id){
    	$single_con = Contact::find($contact_id);
    	return view('admin/contact/single',compact('single_con'));
    }
    function contactAdminviewDeleteSoft($contact_id){
    	// echo $contact_id;
    	Contact::find($contact_id)->delete();
    	return back()->with('del_com','Delete Complete');
    }
    function contactAdminviewTrash(){
    	$contact_trash = Contact::onlyTrashed()->get();

    	return view('admin/contact/trash',compact('contact_trash'));
    }

    function contactAdminViewRestore($contact_id){
    	echo $contact_id;
    	Contact::withTrashed()->find($contact_id)->restore();
    	return back()->with('succ','Message restore complate');
    }

    function contactAdminViewHardDelete($contact_id){
    	echo $contact_id;
    	Contact::onlyTrashed()->find($contact_id)->forceDelete();
    	return back()->with('herd_del','Message Permanent Delete Complete');
    }
}
