<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/','FrontendController@index');

// contact 
Route::get('/contact','FrontendController@contact');
Route::post('/contact/post','FrontendController@contactPost');
Route::get('/contact/admin/view','ContactController@contactAdminview');
Route::get('/contact/admin/view/single/{contact_id}','ContactController@contactAdminviewSingle');
Route::get('/contact/admin/view/delete/soft/{contact_id}','ContactController@contactAdminviewDeleteSoft');
Route::get('/contact/admin/view/trash','ContactController@contactAdminviewTrash');
Route::get('/contact/admin/view/restore/{contact_id}','ContactController@contactAdminViewRestore');
Route::get('/contact/admin/view/delete/hard/{contact_id}','ContactController@contactAdminViewHardDelete');


// about
Route::get('/about','FrontendController@about');

// banner and footer

Route::get('banner/admin','BannerController@adminIndex');
Route::post('banner/admin/add','BannerController@adminIndexAdd');
Route::get('banner/admin/delete/{banner_id}','BannerController@adminIndexdelete');
Route::get('admin/clients','BannerController@adminClients');

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/chart', 'HomeController@chart');
// catagory add
Route::get('/category', 'CategoryController@index');
Route::post('/category/add', 'CategoryController@categoryAdd');
Route::post('/category/update/post', 'CategoryController@categoryUpdatePost');
Route::get('/category/update/{category_id}', 'CategoryController@categoryUpdate');
Route::get('/category/delete/{category_id}', 'CategoryController@categoryDelete');
Route::get('/category/restore/{category_id}', 'CategoryController@categoryRestore');
Route::get('/category/hardDelete/{category_id}', 'CategoryController@categoryHardDelete');

// user profile

Route::get('/profile','ProfileController@index');
Route::post('/profile/post','ProfileController@updateName');
Route::post('/profile/password','ProfileController@passwordPost');

// product routes

Route::get('/product/admin','ProductController@adminIndex');
Route::post('/product/admin/post','ProductController@adminIndexPost');
Route::get('/product/admin/delete/{product_id}','ProductController@adminDeletePost');
Route::get('/product/single/{product_id}','FrontendController@singleView');


// product faq
Route::get('product/admin/faq','FaqController@index');
Route::post('product/admin/faq/post','FaqController@indexPost');
Route::get('product/admin/faq/delete/{faq_id}','FaqController@indexPost');
Route::get('/product/faq','FrontendController@productFaq');


// shop
Route::get('shop','FrontendController@shop');

//blog
Route::get('/blog','FrontendController@blog');
Route::get('/blog/singleview/{single_id}','FrontendController@blogSingle');
Route::get('/blog/admin','BlogController@indexView');
Route::get('/blog/admin/add','BlogController@adminAdd');
Route::post('/blog/admin/add/post','BlogController@blogPost');
Route::get('/blog/admin/delete/{blog_id}','BlogController@blogDelete');

// blog category
Route::get('/blog/admin/add/category','BlogCategoryController@adminAdd');
Route::post('/blog/category/post','BlogCategoryController@addCate');
Route::get('/blog/category/update/post/{category_id}','BlogCategoryController@updateLink');
Route::post('/blog/category/update/com','BlogCategoryController@updateCate');
Route::get('/blog/category/delete/post/{category_id}','BlogCategoryController@delCate');

// cart 
Route::post('/cart/add','CartController@addCart');
Route::get('/cart/view','CartController@cartView');
Route::get('/cart/delete/{cart_id}', 'CartController@cartDelete');
Route::post('/cart/product/update', 'CartController@proUpdate');

// copon system(command)

Route::get('/copon/admin', 'CoponController@admin');
Route::get('/copon/admin/post', 'CoponController@adminPost');