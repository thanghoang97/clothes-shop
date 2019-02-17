<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Color;
use App\Size;
use App\Product;
use App\ProductDetail;
use Carbon\Carbon;
class DashboardController extends Controller
{
	public function index()
	{
		$details = ProductDetail::all();
		$products = Product::all();
		$colors = Color::all();
		$sizes = Size::all();
		$newOrder = count(Order::where('status',0)->get()); // 1
		$currentMonth = date('m');
		$currentDay = date('d');
		$totalOrder = count(DB::table('orders')->whereMonth('created_at', $currentMonth)->where('status',1)->get()); //2
		// dd($totalOrder);
		$totalMonth = number_format(DB::table('orders')->whereMonth('created_at', $currentMonth)->sum('total'));//3
		$totalDay = number_format(DB::table('orders')->whereDay('created_at', $currentDay)->sum('total'));//4

		// $top_sell_day = DB::table('order_detail')->whereDay('created_at', $currentDay) 
		// dd(date('d'));
		$top_sell_day=DB::table('order_detail')
		->select('order_detail.product_detail_id',DB::raw('COUNT(product_detail_id) as count'))
		->whereDay('created_at', $currentDay)
		->groupBy('product_detail_id')
		->orderBy('count','desc')
		->limit(5)
		->get();
		foreach ($top_sell_day as $key => $value) {
			foreach ($details as $detail) {
				if($value->product_detail_id == $detail->id){
					$product_id = $detail->product_id;
					$color_id = $detail->color_id;
					$size_id = $detail->size_id;
					foreach($colors as $color){
						if($color->id == $color_id){
							$color_name_day[$key] = $color->name;
						}
					}
					foreach($sizes as $size){
						if($size->id == $size_id){
							// $size_name = $size->name;
							$size_name_day[$key] = $size->name;
						}
					}
					foreach($products as $prod){
						if($prod->id == $product_id){
							$prod_name_day[$key] = $prod->name;
							$prod_price_day[$key] = $prod->price;
						}
					}
				}
			}
		}

		$top_sell_month=DB::table('order_detail')
		->select('order_detail.product_detail_id',DB::raw('COUNT(product_detail_id) as count'))
		->whereMonth('created_at', $currentMonth)
		->groupBy('product_detail_id')
		->orderBy('count','desc')
		->limit(5)
		->get();
		// dd($top_sell_month);
		foreach ($top_sell_month as $key => $value) {
			foreach ($details as $detail) {
				if($value->product_detail_id == $detail->id){
					$product_id = $detail->product_id;
					$color_id = $detail->color_id;
					$size_id = $detail->size_id;
					foreach($colors as $color){
						if($color->id == $color_id){
							$color_name_month[$key] = $color->name;
						}
					}
					foreach($sizes as $size){
						if($size->id == $size_id){
							// $size_name = $size->name;
							$size_name_month[$key] = $size->name;
						}
					}
					foreach($products as $prod){
						if($prod->id == $product_id){
							$prod_name_month[$key] = $prod->name;
							$prod_price_month[$key] = $prod->price;
						}
					}
				}
			}
		}
		return view('management.dashboard',
			compact(
				'newOrder',"totalOrder",'totalDay','totalMonth',
				'top_sell_day','color_name_day','size_name_day','prod_name_day','prod_price_day',
				'top_sell_month','color_name_month','size_name_month','prod_name_month','prod_price_month'
		));
	}
}
