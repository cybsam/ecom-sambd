<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(){
    	return view('admin/profile/index');
    }

    function updateName(Request $request){
    	$request->validate([
    		'updateName' => 'required'
    	]);
    	$old_name = Auth::user()->name;
    	User::find(Auth::id())->update([
    		'name' => $request->updateName
    	]);
    	
    	return back()->with('update_status','Your Name - '.$old_name.' Succesfully Update to - '.$request->updateName);
    }

    function passwordPost(Request $request){
    	$request -> validate([
    		'oldPassword' => 'required',
    		'password' => 'required|confirmed',
    		'password_confirmation' => 'required'
    	]);
    	if ($request->oldPassword == $request->password) {
    		
    		return back()->withErrors("Your new password can not be your old password");
    	}
    	$old_password_form_user = $request->oldPassword;
    	$user_password_from_database = Auth::user()->password;
    	if (Hash::Check($old_password_form_user,$user_password_from_database)) {
    		User::find(Auth::id())->update([
    			'password' => Hash::make($request->password)
    		]);
    	}else{
    		return back()->withErrors("Your Old password is incorrect Please input correct password");
    	}
    	return back()->with('password_change_status','Your Password Change Succesfully');
    }
}
