<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    function addCart(Request $request){
    	// echo $request->product_id;

    	
    	if (Cart::where('product_id',$request->product_id)->where('ip_address',request()->ip())->exists()){

    		Cart::where('product_id',$request->product_id)->where('ip_address',request()->ip())->increment('quantity',$request->quantity);
            
    	}else{
    		Cart::insert([
    			'product_id' => $request->product_id,
    			'quantity' => $request->quantity,
    			'ip_address' => request()->ip(),
    			'created_at' => Carbon::now()
    		]);
    	}
    	
    	return back();
    }
    // cart view
    function cartView(){
        $carts = Cart::where('ip_address', request()->ip())->get();
        return view('cart', compact('carts'));
    }
    // cart remove
    function cartDelete($cart_id){
        echo $cart_id;
        Cart::find($cart_id)->delete();
        return back();
    }
    // cart update
    function proUpdate(Request $request){
        // print_r($request->all());
        foreach ($request->cart_quantity as $cart_id => $cart_update_quantity) {
            // echo $cart_id."=".$cart_update_quantity."<br>";
            Cart::find($cart_id)->update([
                'quantity' => $cart_update_quantity
            ]);
        }
        return back();
    }
}
