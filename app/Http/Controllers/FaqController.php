<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Carbon\Carbon;
use App\Category;
use App\Faq;

class FaqController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
    	$faqs = Faq::latest()->paginate(10);
    	$products = Product::all();
    	return view('admin/faq/index',compact('products','faqs'));
    }

    function indexPost(Request $request){
    	
    	$request->validate([
    		'faq_question' => 'required',
    		'faq_answare' => 'required'
    	]);

    	Faq::insert([
    		'faq_question' => $request->faq_question,
    		'product_id' => $request->product_id,
    		'faq_answare' => $request->faq_answare,
    		'created_at' => Carbon::now()
    	]);
    	// echo $request->product_id;

    	return back()->with('insert_success','Faq Add Succesfully');
    }
}
