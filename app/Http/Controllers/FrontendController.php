<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_multiple_photos;
use App\Contact;
use App\Banner;
use App\Faq;
use App\Blog;
use App\BlogCategory;
use Carbon\Carbon;

class FrontendController extends Controller
{
    // main front
	function index(){

		return view('index',[
			'categories' => Category::all(),
            'products' => Product::latest()->get(),
            'banner_pic' => Banner::all(),
            'product_faqs' => Faq::all()
		]);
	}
    // end
    // about area
    function about(){
        return view('about');
    }
    // end about area

    // start contact area

    function contact(){
    	return view('contact');
    }
    // send message
    function contactPost(Request $request){
        $request->validate([
            'fname' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        Contact::insert([
            'fname' => $request->fname,
            'email' => $request->email,
            'subject' => $request->subject,
            'description' => $request->message,
            'created_at' => Carbon::now()
        ]);
        return redirect('contact#contact')->with('sent_succ','Your Message Sent Succesfully');
    }
    // end contact area

    // product area
    function singleView($product_id){
        // print_r(request()->ip());
        // die();
        // echo $product_id;
        $category_id = Product::find($product_id)->category_id;

        $product_info = Product::find($product_id);
        $faqs_info = Faq::all();
        $related_products = Product::where('category_id', $category_id)->where('id','!=', $product_id)->limit(4)->get();
        $multiple_photos = Product_multiple_photos::where('product_id',$product_id)->get();

        return view('admin/product/single', compact('product_info','faqs_info','related_products','multiple_photos'));
    }
    // function singleView($product_id){
    //     // echo $product_id;
    //     $product_info = Product::find($product_id);
    //     return view('admin/product/single', compact('product_info'));
    // }

    function productFaq(){
        $all_faqs = Faq::latest()->paginate(5);
        return view('faq',compact('all_faqs'));
    }

    function shop(){
        return view('shop',[
            'products' => Product::all(),
            'Categories' =>Category::all()
        ]);
    }
    function blog(){
        $allBlog = Blog::latest()->paginate(6);
        return view('blog',compact('allBlog'));
    }
    function blogSingle($single_id){
        $single_blog = Blog::find($single_id);
        $blog_category = BlogCategory::all();
        return view('blog_single',compact('single_blog','blog_category'));
    }
}
