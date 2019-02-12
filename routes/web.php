<?php

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

Route::get('/','ShopController@index')->name('shop.index');
Route::get('/detail/{slug}','ShopController@detail')->name('shop.detail');
Route::get('/products','ShopController@products')->name('shop.products');
Route::post('/add2cart/{id}','ShopController@add2cart')->name('shop.add2cart');
Route::get('/menuCart','ShopController@menuCart')->name('shop.menuCart');
// Route::get('/login', function () {
//     // return view('layouts.master');
//     return view('shop.login');
// });
// Route::get('/register', function () {
//     // return view('layouts.master');
//     return view('shop.register');
// });
Route::get('/cart','ShopController@cart')->name('shop.cart');


// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/user')->group(function(){
	Auth::routes();
	// Route::resource('user','UserAdminController');
    // Route::get('login', 'Auth\LoginController@showLoginForm');
    // Route::post('login', 'Auth\LoginController@login');
    // Route::post('logout', 'Auth\LoginController@logout');


 //    Route::post('/getdata', 'UserAdminController@getdata');
	// Route::get('/index', 'UserAdminController@index');
});	

Route::prefix('/admin')->group(function(){
    Auth::routes();
    // Route::get('/loginform',function(){
    //     // dd('xcvxc');
    //     return view('admin_auth.login');
    // });
    // Route::get('/login',function(){
    //     // dd('xcvxc');
    //     return view('admin_auth.login');
    // });
    Route::get('/home',function(){
        // return view('management.listUser');
       return view('management.homeAdmin');
   });
    Route::get('login', 'AuthAdmin\LoginController@showLoginForm')->name('login');
    Route::post('login', 'AuthAdmin\LoginController@login');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('logout');
    /**
     * Route của USER
     */
    Route::get('user/getdata','UserManagerController@getdata')->name('user.getdata');
    Route::post('user','UserManagerController@store')->name('user.store');
    Route::get('user/detail','UserManagerController@show')->name('user.show');
    Route::get('user/edit','UserManagerController@edit')->name('user.edit');
    Route::put('user/{id}','UserManagerController@update')->name('user.update');
    Route::get('user/destroy', 'UserManagerController@destroy')->name('user.destroy');
    Route::get('user','UserManagerController@index')->name('user.index');
    /**
     * Route của CATEGORY
     */
    Route::get('category/getdata','CategoryManagerController@getdata')->name('cate.getdata');
    Route::post('category','CategoryManagerController@store')->name('cate.store');
    Route::get('category/detail','CategoryManagerController@show')->name('cate.show');
    Route::get('category/edit','CategoryManagerController@edit')->name('cate.edit');
    Route::put('category/{id}','CategoryManagerController@update')->name('cate.update');
    Route::get('category/destroy', 'CategoryManagerController@destroy')->name('cate.destroy');
    Route::get('category','CategoryManagerController@index')->name('cate.index');

    /**
     * Route của PRODUCT
     */

    Route::get('product/getdata','ProductManagerController@getdata')->name('prod.getdata');
    Route::get('product','ProductManagerController@index')->name('prod.index');
    Route::post('product','ProductManagerController@store')->name('prod.store');
    Route::get('product/edit','ProductManagerController@edit')->name('prod.edit');
    Route::put('product/{id}','ProductManagerController@update')->name('prod.update');
    Route::get('product/destroy', 'ProductManagerController@destroy')->name('prod.destroy');
    
    /**
     * Route của PRODUCT DETAIL
     */
    Route::get('detail/getdetail/{id}/{btn_id}','ProductDetailManagerController@getDetail')->name('detail.getdetail');
    Route::post('detail','ProductDetailManagerController@store')->name('detail.store');
    Route::get('detail/destroy', 'ProductDetailManagerController@destroy')->name('detail.destroy');
    Route::get('detail/edit','ProductDetailManagerController@edit')->name('detail.edit');
    Route::put('detail/{id}','ProductDetailManagerController@update')->name('detail.update');

    /**
     * Upload Multi Dropzone
     */
    Route::get('/', 'UploadImagesController@create');
    Route::post('/images-save', 'UploadImagesController@store');
    Route::get('/images-delete', 'UploadImagesController@destroy')->name('img.destroy');
    Route::get('/images-show', 'UploadImagesController@show');
});  