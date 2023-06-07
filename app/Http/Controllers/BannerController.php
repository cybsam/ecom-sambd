<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Image;

class BannerController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    function adminIndex(){
    	$banners = Banner::all();
    	return view('admin/bannerAndfooter/index',compact('banners'));
    }

    function adminIndexAdd(Request $request){
    	// echo $request->banner_alt;
    	$request->validate([
    		'banner_alt' => 'required',
    		'banner_photo' => 'required'
    	]);

    	$banner_id = Banner::insertGetId([
    		'banner_picture_alt' => $request->banner_alt,
    		'banner_picture' => $request->banner_alt,
    		'created_at' => Carbon::now()
    	]);

    	$banner_picture = $request->file('banner_photo');
    	$new_name = $banner_id.".".$banner_picture->getClientOriginalExtension();
    	$new_location = base_path('public/uploads/banner_photos/'.$new_name);
    	Image::make($banner_picture)->resize(1920,1000)->save($new_location);

    	Banner::find($banner_id)->update([
    		'banner_picture' => $new_name
    	]);

    	return back()->with('success','Banner Picture add success');
    }
    function adminIndexdelete($banner_id){
    	echo $banner_id;
    	unlink(base_path('public/uploads/banner_photos/'.Banner::find($banner_id)->banner_picture));
    	Banner::find($banner_id)->delete();
    	return back()->with('del_com','Banner Picture Delete Complete');
    }


    // clients review
    function adminClients(){
        return view('admin/bannerAndfooter/clients');
    }
}
