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

Route::get('/', function () {
    // return view('layouts.master');
    return view('shop.home');
});
Route::get('/detail', function () {
    // return view('layouts.master');
    return view('shop.detail');
});
Route::get('/product', function () {
    // return view('layouts.master');
    return view('shop.product');
});
Route::get('/login', function () {
    // return view('layouts.master');
    return view('shop.login');
});
Route::get('/register', function () {
    // return view('layouts.master');
    return view('shop.register');
});


// Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('/user')->group(function(){
	Auth::routes();
	Route::resource('user','UserAdminController');
    Route::get('login', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
	Route::get('user/getdata', 'UserAdminController@getdata');
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
        return view('home');
    });
    Route::get('login', 'AuthAdmin\LoginController@showLoginForm')->name('login');
    Route::post('login', 'AuthAdmin\LoginController@login');
    Route::post('logout', 'AuthAdmin\LoginController@logout')->name('logout');
});    