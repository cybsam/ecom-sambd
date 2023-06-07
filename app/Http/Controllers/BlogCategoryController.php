<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogCategory;

use Carbon\Carbon;


class BlogCategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

	function adminAdd(){
		$allCategory = BlogCategory::latest()->paginate(5);
    	return view('admin/blog/category',compact('allCategory'));
    }




    function addCate(Request $request){
    	echo $request->category_name;

    	$request->validate([
    		'category_name' => 'required|unique:blog_categories,blog_category'
    	]);

    	BlogCategory::insert([
    		'blog_category' => $request->category_name,
    		'created_at' => Carbon::now()
    	]);
    	return back()->with('success','Blog Category Add Success');
    }

    function delCate($category_id){
    	echo $category_id;
    	BlogCategory::find($category_id)->delete();
    	return back()->with('del_com','Category Delete Complete');
    }

    function updateLink($category_id){
    	// echo $category_id;
    	$categories = BlogCategory::find($category_id)->blog_category;
    	return view('admin/blog/cateUpdate', compact('categories','category_id'));
    }
    function updateCate(Request $request){
    	// echo $request->cate_name;
    	// echo $request->category_id;

    	BlogCategory::find($request->category_id)->update([
    		'blog_category' => $request->cate_name
    	]);
    	return redirect('/blog/admin/add/category')->with('update_com','Blog Category Update Complete');

    }
}
