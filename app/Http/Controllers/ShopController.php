<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use Gloudemans\Shoppingcart\Facades\Cart;
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

    public function add2cart(Request $request, $id)
    {
        $product = Product::find($id);
        $img = ProductImage::where('product_id',$id)->first();
        $size = $request->size;
        $color = $request->color;
        $qty = $request->qty;
        Cart::add(['id' => $id,'name'=> $product->name,'qty' => $qty,'price'=> $product->price,'options' =>['size' => $size,'color' =>$color,'img' => $img->filename]]);
        // dd(Cart::content());
        // echo "ss";
    }
    public function menuCart()
    {
        $output ="";
        foreach(Cart::content() as $row){
            $output .=
            '<li class="header-cart-item flex-w flex-t m-b-12">
            <div class="header-cart-item-img">
            <img src="/images/'.$row->options->img.'" alt="IMG">
            </div>
            
            <div class="header-cart-item-txt p-t-8">
            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                '.$row->name.'
            </a>
            
            <span class="header-cart-item-info">
            Size:' .$row->options->size.' - Color: ' .$row->options->color.' - $'.$row->price.' - x'.$row->qty.'
            </span>
            </div>
            </li>';
        }
        return response()->json(['output' => $output]);
    }
}
