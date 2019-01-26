<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
class ShopController extends Controller
{
	public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $products = Product::take(20)->get();
        return view('shop.index',compact('products'));
    }
    public function products(){
    	$products = Product::take(20)->get();
    	// $details = Product::with('details')->get();
    	// dd($relate[0]->details);
        return view('shop.product',compact('products'));
    }
    public function detail($slug)
    {
    	// lấy detail product theo slug
    	$product = Product::where('slug',$slug)->first();
    	// lấy sp + quan hệ bên bảng detail
    	$detail = Product::with('details')->find($product->id);
    	return view('shop.detail',compact('product','detail'));
    }
    public function cart()
    {
    	return view('shop.cart');
    }
}
