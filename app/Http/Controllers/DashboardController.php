<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\ProductDetail;
use Carbon\Carbon;
class DashboardController extends Controller
{
	public function index()
	{
		$newOrder = count(Order::where('status',0)->get()); // 1
		$currentMonth = date('m');
		$currentDay = date('d');
		$totalOrder = count(DB::table('orders')->whereMonth('created_at', $currentMonth)->get()); //2
		// dd($totalOrder);
		$totalMonth = number_format(DB::table('orders')->whereMonth('created_at', $currentMonth)->sum('total'));//3
		$totalDay = number_format(DB::table('orders')->whereDay('created_at', $currentDay)->sum('total'));//4

		// $top_sell_day = DB::table('order_detail')->whereDay('created_at', $currentDay) 
		// dd(date('d'));
		$test=DB::table('order_detail')
		->select('order_detail.product_detail_id',DB::raw('COUNT(product_detail_id) as count'))
		->whereDay('created_at', $currentDay)
		->groupBy('product_detail_id')
		->orderBy('count','desc')
		->limit(5)
		->get();
		dd($test);
		return view('management.dashboard');
	}
}
