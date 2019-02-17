<?php

namespace App\Http\Controllers;

use App\Order;
use App\Color;
use App\Size;
use App\OrderDetail;
use App\Product;
use App\ProductDetail;
use Datatables;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function index()
	{
		return view('management.order');
	}
	public function getOrder()
	{
		$order = Order::orderBy('id','desc');
		return Datatables::of($order)
		->addColumn('action', function($order){
			return '
			<form action="'.route("order.deleteCart",$order->code).'" method="post">
				<input class="btn btn-danger" value="X" type="submit" style="display: inline-block" />
				'.csrf_field().'
				</form>';
		})
		->editColumn('status',function($order){
			if($order->status == 0){
				return '<a class="btn btn-primary btn-detail" data-id="'.$order->code.'"​ href="'.route('order.checkbill',$order->code).'"><i class="fa fa-file-text" aria-hidden="true"></i></a>';
			}
			if($order->status == 1){
				return '<a class="btn btn-success btn-detail" data-id="'.$order->code.'"​ href="'.route('order.checkbill',$order->code).'"><i class="fa fa-check" aria-hidden="true"></i></a>';
			}
		})->rawColumns(['status', 'action'])->toJson();
	}
	public function checkBill($id)
	{
		$orDetails = OrderDetail::where('order_code',$id)->get();
		$order = Order::where('code',$id)->first();
		$tDetails = ProductDetail::all();
		$products = Product::all();  
    	// $pDetails[];
		foreach($orDetails as $value){
			$pDetails[$value->product_detail_id] = $value->product_detail_id; 
		}
    	// dd($pDetails);
		$sizes = Size::all();
		$colors = Color::all();
		return view('management.bill',compact('orDetails','sizes','colors','pDetails','tDetails','products','order'));
	}
	public function deleteCart($id){
    	// dd($id);
		$order = Order::where('code',$id)->delete();
		$detail = OrderDetail::where('order_code',$id)->delete();
		return redirect()->route('order.index');   
	}
	public function confirmCart($id, Request $request)
	{
		$details = ProductDetail::all();
		$ordDetail = OrderDetail::where('order_code',$id)->get();
		foreach($ordDetail as $ord){
			foreach($details as $detail){
				if($detail->quantity < $ord->quantity){
					$request->session()->flash('error');
					return redirect()->route('order.index'); 
				}
				if($ord->product_detail_id == $detail->id){
					$detail->quantity = $detail->quantity-$ord->quantity;
					$detail->sold = $detail->sold + $ord->quantity;
					$detail->save();
				}
			}
		}
		$order = Order::where('code',$id)->first();
		$order->status = 1;
		$order->save();
		return redirect()->route('order.index');   
	}
}
