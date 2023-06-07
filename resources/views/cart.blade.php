@extends('layouts.frontend_master')
@section('frontEnd')

<div class="responsive-menu-area">
              <div class="container">
                  <div class="row">
                      <div class="col-12 d-block d-lg-none">
                          <ul class="metismenu">
                              <li><a href="index.html">Home</a></li>
                              <li><a href="about.html">About</a></li>
                              <li class="sidemenu-items">
                                  <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Shop </a>
                                  <ul aria-expanded="false">
                                      <li><a href="shop.html">Shop Page</a></li>
                                      <li><a href="single-product.html">Product Details</a></li>
                                      <li><a href="cart.html">Shopping cart</a></li>
                                      <li><a href="checkout.html">Checkout</a></li>
                                      <li><a href="wishlist.html">Wishlist</a></li>
                                  </ul>
                              </li>
                              <li class="sidemenu-items">
                                  <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Pages </a>
                                  <ul aria-expanded="false">
                                    <li><a href="about.html">About Page</a></li>
                                    <li><a href="single-product.html">Product Details</a></li>
                                    <li><a href="cart.html">Shopping cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                  </ul>
                              </li>
                              <li class="sidemenu-items">
                                  <a class="has-arrow" aria-expanded="false" href="javascript:void(0);">Blog</a>
                                  <ul aria-expanded="false">
                                      <li><a href="blog.html">Blog</a></li>
                                      <li><a href="blog-details.html">Blog Details</a></li>
                                  </ul>
                              </li>
                              <li><a href="contact.html">Contact</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <!-- responsive-menu area start -->
      </div>
  </header>
  <!-- header-area end -->
    <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ url('/cart/product/update') }}" method="post">
                    	@csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@php
                            		$sub_total_cart = 0;
                            	@endphp
                            	@forelse ($carts as $cart)
                            		
                                <tr>
                                    <td class="images">
                                    	<img src="{{ asset('uploads/product_photos') }}/{{ App\Product::find($cart->product_id)->product_thumbnail_photo }}" alt="">
                                    </td>
                                    <td class="product">
                                    	<a href="{{ url('/product/single') }}/{{ $cart->product_id }}">{{ $cart->cartTo_product->product_name }}</a></td>
                                    <td class="ptice">BDT {{ $cart->cartTo_product->product_price }}
                                    </td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" name="cart_quantity[{{ $cart->id }}]" value="{{ $cart->quantity }}" />
                                    </td>
                                    <td class="total">
                                    	BDT {{ $cart->cartTo_product->product_price * $cart->quantity }}
                                    	@php
                                    		$sub_total_cart = $sub_total_cart + ($cart->cartTo_product->product_price * $cart->quantity);
                                    	@endphp
                                    </td>
                                    <td class="remove">
                                    	<a href="{{ url('cart/delete') }}/{{ $cart->id }}"><i class="fa fa-times"></i></a>
                                    </td>
                                    @empty
                                	<td>
                                		<span class="text-danger">No Product In Cart</span>
                                	</td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button type="submit">Update Cart</button>
                                        </li>
                                    </form>
                                        <li>
                                        	<a href="{{ url('/shop') }}">Continue Shopping</a>
                                        </li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Apply Cupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Subtotal </span>BDT {{ $sub_total_cart }}</li>
                                        <li><span class="pull-left"> Total </span> BDT ------</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

@endsection