<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Carbon\Carbon;
Use Image;

class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	function index(){
		$category = Category::all();
		$delete_category = Category::onlyTrashed()->get();
		return view('admin/category/index',compact('category','delete_category'));
	}


	function categoryAdd(Request $request){
		$request->validate([
			'cateName' => 'required|unique:categories,category_name',
			'category_photo' => 'required|image'
		],[
			'cateName.required' => 'Where is your category name !'
		]);


		$cat_id = Category::insertGetId([
			'category_name' => $request->cateName,
			'user_id' => Auth::user()->id,
			'category_photo' => $request->cateName,
			'created_at' => Carbon::now()
		]);
		// image processing
		$category_photo = $request->file('category_photo');
		$new_name = $cat_id.".".$category_photo->getClientOriginalExtension();
		$new_location = base_path('public/uploads/category_photos/'.$new_name);
		Image::make($category_photo)->resize(600,470)->save($new_location);

		// database image insert

		Category::find($cat_id)->update([
			'category_photo' => $new_name
		]);

		return back()->with('success','Category add succesfully');
	}

	function categoryUpdate($categori_id){
		// echo $categori_id;
		$cate_name = Category::find($categori_id)->category_name;
		$category_photo = Category::find($categori_id)->category_photo;
		return view('admin/category/edit', compact('cate_name','categori_id','category_photo'));
	}


	function categoryUpdatePost(Request $request){
		if ($request->hasFile('new_photo')) {
			// delete photo start
			$del_old_pic = base_path('public/uploads/category_photos/'.Category::find($request->categori_id)->category_photo);
			unlink($del_old_pic);
		// old photo delete complete
		// upload new picture
			$category_photo = $request->file('new_photo');
			$new_name = $request->categori_id.".".$category_photo->getClientOriginalExtension();
			$new_location = base_path('public/uploads/category_photos/'.$new_name);
			Image::make($category_photo)->resize(600,470)->save($new_location);
		// done
		// db update
			Category::find($request->categori_id)->update([
				'category_photo' => $new_name
			]);
		}
		
		// print_r($request->file('new_photo'));

		Category::find($request->categori_id)->update([
			'category_name' => $request->cateName
			
		]);
		return redirect('/category')->with('update_status','Category Update Succesfully');
	
	}

	function categoryDelete($categori_id){
		// echo $categori_id;
		Category::find($categori_id)->delete();
		return back()->with('dlt_com', 'Delete Complete');
	}

	// restore category
	function categoryRestore($categori_id){
		// echo $categori_id;
		Category::withTrashed()->find($categori_id)->restore();
		return back()->with('update_status','Restore Complete!');
	}

	// hard delete
	function categoryHardDelete($categori_id){
		unlink(base_path('public/uploads/category_photos/'.Category::withTrashed()->find($categori_id)->category_photo));
		Category::onlyTrashed()->find($categori_id)->forceDelete();
		return back()->with('dlt_com','Category Hard Delete Complete');
	}
}
