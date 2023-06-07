<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Product_multiple_photos;
use Carbon\Carbon;
use App\Auth;
use Image;


class ProductController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    function adminIndex(){
    	$category = Category::all();
        $products = Product::all();
    	return view('admin/product/index',compact('category','products'));
    	// other option
    	// return view('admin/product/index',[
    	// 	'category' => Category::all()
    	// ]);
    }

    function adminIndexPost(Request $request){

        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_short' => 'required',
            'product_description' => 'required',
            'product_thuambnail' => 'required'
        ]);
    	
    	$product_id = Product::insertGetId([
    		'product_name' => $request->product_name,
    		'category_id' => $request->category_id,
    		'product_price' => $request->product_price,
    		'product_quantity' => $request->product_quantity,
    		'product_short_description' => $request->product_short,
    		'product_description' => $request->product_description,
    		'product_thumbnail_photo' => 'product_thumbnail_photo',
    		'created_at' => Carbon::now()
    	]);
    	$product_photo = $request->file('product_thuambnail');
		$new_name = $product_id.".".$product_photo->getClientOriginalExtension();
		$new_location = base_path('public/uploads/product_photos/'.$new_name);
		Image::make($product_photo)->resize(600,622)->save($new_location);

		Product::find($product_id)->update([
			'product_thumbnail_photo' => $new_name
		]);

        // multiple add start
        $flag = 1;
        foreach ($request->file('product_multiple_picture') as $product_multiple_photo) {
            
            $product_photo_multi = $product_multiple_photo;
            $new_name_multi =$product_id."-".$flag.".".$product_photo_multi->getClientOriginalExtension();
            $new_location = base_path('public/uploads/product_multiple_photos/'.$new_name_multi);
            Image::make($product_photo_multi)->resize(600,550)->save($new_location);
            
            Product_multiple_photos::insert([
                'product_id' => $product_id,
                'multiple_photos' => $new_name_multi,
                'created_at' => Carbon::now()
            ]);
            $flag++;
        }
        // multiple add end
		return back()->with('pro_add_succ','Product Add Success');

    
    }
    function adminDeletePost($product_id){
        echo $product_id;
        Product::find($product_id)->delete();
        return back()->with('delete_com','Product Delete Complete');
    }
}
