<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Copon;
use Carbon/Carbon;


class CoponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function admin(){
    	return view('admin/copon/index');
    }

    function adminPost(Request $request){
    	echo "ok";
    	$request->validate([
    		'copon_name' => 'required|unique:copons,copon_name',
    		'copon_discount' => 'required|numeric|min:1|max:99',
    		'copon_validity' => 'required'
    	]);
    }
}
