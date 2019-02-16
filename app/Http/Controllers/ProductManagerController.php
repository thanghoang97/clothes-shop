<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Datatables;
use Validator;
use Auth;
use App\ProductDetail;
use App\Category;
class ProductManagerController extends Controller
{
	public function __construct()
	{
		$this->middleware('admin.auth');
	}

	public function index()
	{   
		return view('management.product');
	}
	public function getdata()
	{
		$categories = Category::all();
		$products = Product::select('id','code','name','slug','description','sale_price','price','category_id','content');
		return Datatables::of($products)
		->addColumn('action', function($product){
			return '
			<button class="btn btn-primary btn-detail" data-id="'.$product->id.'"​><i class="fa fa-plus-square" aria-hidden="true"></i></button>
			<a class="btn btn-warning btn-edit" data-id="'.$product->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
			
			<button class="btn btn-danger btn-delete" data-id="'.$product->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
		})->editColumn('price',function($product){
			return number_format($product->price);
		})->editColumn('sale_price',function($product){
			return number_format($product->sale_price);
		})->editColumn('category_id',function($product) use($categories){
			foreach($categories as $cate){
				if($cate->id === $product->category_id){
					return $cate->name;
				}
			}
		})->make(true);
	}
	
	public function store(Request $request)
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

		// dd($request->all());
		$validator = Validator::make($request->all(),[
			'code' => 'required|min:4|max:10|unique:products',
			'name' => 'required|min:4|max:20',
			'description' => 'required|min:4',
			'content' => 'required|min:4',
			'price' => 'required|max:11',
		]);
		$errors = array();
		$success = '';
		if($validator->fails()){
			foreach ($validator->messages()->getMessages() as $value => $messages) {
				$errors[] = $messages;
			}
			return response()->json(['errors'=>$errors]);
		}else{
			$prod = new Product;
			$prod->code = $request->code;
			$prod->name = $request->name;
			$prod->slug = $request->slug.'.'.time();
			$prod->description = $request->description;
			$prod->content = $request->content;
			$prod->sale_price = (float) priceToFloat($request->sale_price);
			$prod->price =  (float) priceToFloat($request->price);
			$prod->category_id = $request->category;
			$prod->admin_created_id = Auth::guard('admin')->user()->id;
			$prod->save();
			return response()->json(['product' => $prod]);
		}
	}
	public function edit(Request $request)
	{
		$id = $request->input('id');
		$prod = Product::find($id);
		$output = array(
			'id' => $prod->id,
			'code'    =>  $prod->code,
			'slug'     =>  $prod->slug,
			'name'     =>  $prod->name,
			'description'     =>  $prod->description,
			'content'     =>  $prod->content,
			'price'     =>   number_format($prod->price),
			'sale_price'     =>   number_format($prod->sale_price),
			'category'     =>  $prod->category_id,
		);
		echo json_encode($output);
	}
	public function update($id, Request $request)
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
		$validator = Validator::make($request->all(),[
			'code' => 'required|min:4|max:10|unique:users,username,'.$id,
			'name' => 'required|min:4|max:20',
			'description' => 'required|min:4',
			'price' => 'required|max:11',
		]);
		$errors = array();
		$success = '';
		if($validator->fails()){
			foreach ($validator->messages()->getMessages() as $value => $messages) {
				$errors[] = $messages;
			}
			return response()->json(['errors'=>$errors]);
		}else{
			$prod = Product::find($id);
			$prod->code = $request->code;
			$prod->name = $request->name;
			$prod->slug = $request->slug.'-'.time();
			$prod->description = $request->description;
			$prod->content = $request->prod_edit_content;
			$prod->sale_price = (float) priceToFloat($request->sale_price);
			$prod->price = (float) priceToFloat($request->price);
			$prod->category_id = $request->category;
			$prod->admin_updated_id = Auth::guard('admin')->user()->id;
			$prod->save();

			return response()->json(['product' => $prod]);
		}
	}
	public function destroy(Request $request)
	{
		$prod = Product::find($request->input('id'));
		$delete = ProductDetail::where('product_id',$request->input('id'))->delete();
		if($prod->delete())
		{
			echo 'Data Deleted';
		}
	}
}
