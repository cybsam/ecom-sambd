<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategory;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    function indexView(){
        $allBlog = Blog::latest()->paginate(5);
    	return view('admin/blog/index',compact('allBlog'));
    }
    function adminAdd(){
        $allCategories = BlogCategory::all();
    	return view('admin/blog/add',compact('allCategories'));
    }

    function blogPost(Request $request){
        // echo $request->blog_category;
        $request->validate([
            'blog_name' => 'required',
            'blog_category' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'blog_image' => 'required'
        ]);
        $blog_id = Blog::insertGetId([
            'blog_name' => $request->blog_name,
            'blog_category' => $request->blog_category,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'blog_image' => 'image',
            'created_at' => Carbon::now()
        ]);
        $blog_img = $request->file('blog_image');
        $new_name = $blog_id.".".$blog_img->getClientOriginalExtension();
        $new_location = base_path('public/uploads/blog_photos/').$new_name;
        Image::make($blog_img)->resize(500,364)->save($new_location);

        Blog::find($blog_id)->update([
            'blog_image' => $new_name
        ]);
        return back()->with('blog_add','Blog Post Add Successfully');

    }
    function blogDelete($blog_id){
        // echo $blog_id;
        unlink(base_path('public/uploads/blog_photos/'.Blog::find($blog_id)->blog_image));
        Blog::find($blog_id)->delete();
        return back()->with('delete_complete','Blog Post Delete Complete');
    }
}
