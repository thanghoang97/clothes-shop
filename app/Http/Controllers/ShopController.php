<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Color;
use App\Size;
use App\ProductDetail;
use App\ProductImage;
use App\Order;
use App\OrderDetail;
use Gloudemans\Shoppingcart\Facades\Cart;
class ShopController extends Controller
{
	public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $thumb = array();
        $products = Product::take(20)->orderBy('id','desc')->get();
        $images = ProductImage::all();
        foreach($products as $prod){
            foreach ($images as $img) {
                if($img->product_id == $prod->id){
                    $thumb[$prod->id] = $img->filename;
                    break;
                }
            }
        }       
        return view('shop.index',compact('products','thumb'));
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
        $images = ProductImage::where('product_id',$product->id)->take(5)->get();
        // dd($images);
        return view('shop.detail',compact('product','detail','images'));
    }
    public function cart()
    {
    	return view('shop.cart');
    }

    public function add2cart(Request $request, $id)
    {
        $product = Product::find($id);
        $img = ProductImage::where('product_id',$id)->first();
        // $size = $request->size;
        $size = Size::find($request->size);
        // $color = $request->color;
        $color = Color::find($request->color);
        $qty = $request->qty;
        // detail de tim id trong table product detail
        $detail = ProductDetail::where([['color_id',$request->color],['size_id',$request->size],['product_id',$id]])->first();
        Cart::add(['id' => $id,'name'=> $product->name,'qty' => $qty,'price'=> $product->price,'options' =>['size' => $size->name,'color' =>$color->name,'img' => $img->filename,'totalQty' => $request->totalQty,'detail_id'=>$detail->id]]);
        // dd(Cart::content());
    }
    public function updateCart($id,Request $request)
    {
        Cart::update($request->rowId, $request->qty);
    }
    public function menuCart()
    {
        $output ="";
        foreach(Cart::content() as $key => $row){
            $output .=
            '<li class="header-cart-item flex-w flex-t m-b-12">
            <div class="header-cart-item-img" data-key="'.$key.'">
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
    public function deleteCart(Request $request)
    {
        $rowId = $request->id;
        Cart::remove($rowId);
    }
    public function getColor(Request $request)
    {
        $option = "";
        $output ="";
        $colors = ProductDetail::where([['product_id',$request->id],['size_id',$request->size]])->get();

        $table_Color = Color::all();
        
        foreach($colors as $color){
            foreach($table_Color as $value){
                if($color->color_id == $value->id){
                    $output .= '<option data-id="'.$color->color_id.'" data-qty="'.$color->quantity.'">'.$value->name.'</option>';
                }
            }     
        }
        return response()->json(['output' => $output]);
    }
    public function infoCart()
    {
        $output ="";

        foreach(Cart::content() as $key => $row){
            $output .=
            '<tr class="table_row">
            <td class="column-1">
            <div class="how-itemcart1" data-key="'.$key.'">
            <img src="/images/'.$row->options->img.'" alt="IMG">
            </div>
            </td>
            <td class="column-2">'.$row->name.' - '.$row->options->size.' - '.$row->options->color.'</td>
            <td class="column-3">$ '.$row->price.'</td>
            <td class="column-4">
            <div class="wrap-num-product flex-w m-l-auto m-r-0">
            <div class="btn-minus cl8 hov-btn3 trans-04 flex-c-m minus_prod" data-rowid="'.$key.'" data-id="'.$row->id.'" style="width: 45px">
            <i class="fs-16 zmdi zmdi-minus"></i>
            </div>

            <input class="mtext-104 cl3 txt-center num-product qty" type="number" name="num-product1" value="'.$row->qty.'" data-total="'.$row->options->totalQty.'" >

            <div class="btn-plus cl8 hov-btn3 trans-04 flex-c-m plus_prod" data-rowid="'.$key.'" data-id="'.$row->id.'" style="width: 45px">
            <i class="fs-16 zmdi zmdi-plus"></i>
            </div>
            </div>
            </td>
            <td class="column-5">$ '.$row->total.'</td>
            </tr>';
        }
        $subTotal = Cart::subtotal();
        return response()->json(['output' => $output,'subTotal' => $subTotal]);
    }
    public function checkOut()
    {
        return view('shop.checkout');
    }
    public function infoUser(Request $request)
    {
        function priceToFloat($s)
        {
            // convert "," to "."
            $s = str_replace(',', '.', $s);
            // remove all but numbers "."
            $s = preg_replace("/[^0-9\.]/", "", $s);

            // check for cents
            $hasCents = (substr($s, -3, 1) == '.');
            // remove all seperators
            $s = str_replace('.', '', $s);
            // insert cent seperator
            if ($hasCents)
            {
                $s = substr($s, 0, -2) . '.' . substr($s, -2);
            }
            // return float
            return (float) $s;
        }

        $order = new Order;
        $order->code = "HD-".date('YmdHi').substr($request->mobile,-4);
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->mobile = $request->mobile;
        $order->total = priceToFloat(Cart::total());
        $order->status = 0; 
        $order->customer_id = 0; 
        $order->save();

        $id = $order->id;
        foreach (Cart::content() as $value) {
            $detail = new OrderDetail;
            $detail->order_id = $id;
            $detail->order_code = $order->code;
            $detail->product_id = $value->id;
            $detail->product_detail_id = $value->options->detail_id;
            $detail->quantity = $value->qty;
            $detail->sub_total = $value->total;
            $detail->save();
        }
        Cart::destroy();
        return redirect()->route('shop.index');     
    }
}
