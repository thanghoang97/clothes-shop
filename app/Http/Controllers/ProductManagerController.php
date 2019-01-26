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
			return '<a class="btn btn-warning btn-edit" data-id="'.$product->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<button type="button" class="btn btn-info btn-show" data-id="'.$product->id.'"​><i class="fa fa-eye" aria-hidden="true"></i></button>
			<button class="btn btn-danger btn-delete" data-id="'.$product->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
		})->make(true);
	}
	public function store(Request $request)
	{
		// dd($request->all());
   		// $messages = [
     //        'required' => 'Trường :attribute bắt buộc nhập.',
     //        'email' => 'Trường :attribute bắt buộc nhập email.',
     //        'confirmed' => 'Hai trường mật khẩu đã nhập không giống nhau.',
     //        'min' => ':attribute Không được nhỏ hơn :min',
     //    ];
     //    $validator = Validator::make($request->all(),[
     //        'name' => 'required|min:5',
     //        'username' => 'required|unique:users|min:5',
     //        'email' => 'required|email|unique:users|min:6',
     //        'password' => 'required|confirmed|min:6',
     //    ],$messages);
     //    $errors = array();
     //    $success = '';
     //    if($validator->fails()){
     //        foreach ($validator->messages()->getMessages() as $value => $messages) {
     //            $errors[] = $messages;
     //        }
     //        return response()->json(['errors'=>$errors]);
     //    }else{
		$prod = new Product;
		$prod->code = $request->code;
		$prod->name = $request->name;
		$prod->slug = $request->slug.'-'.time();
		$prod->description = $request->description;
		$prod->content = $request->content;
		$prod->sale_price = $request->sale_price;
		$prod->price = $request->price;
		$prod->category_id = $request->category;
		$prod->admin_created_id = Auth::guard('admin')->user()->id;
        $prod->save();

		$prod_id = $prod->id;
		$detail = new ProductDetail;
		$product_detail = [];
		
		foreach ($request->colors as $color) {
			foreach ($request->sizes as $size) {
				$product_detail[] = [
					'product_id' => $prod_id,
					'quantity' => $request->quantity,
					'sold' => 0,
					'color_id' => $color,
					'size_id' => $size,
				];
			}
		}
		$detail->insert($product_detail); 
            return response()->json(['product' => $prod]);
        // }
	}
	public function edit(Request $request)
	{
		$id = $request->input('id');
        $prod = Product::find($id);
        $detail = ProductDetail::where('product_id',$id)->get();
        $color = [];
        $size = [];
        foreach ($detail as $value) {
        	$color[] = $value->color_id;
        	// dd($color);
        	$size[] = $value->size_id;
        	$quantity = $value->quantity;
        }
        $color = array_unique($color);
        $size = array_unique($size);
        $output = array(
            'id' => $prod->id,
            'code'    =>  $prod->code,
            'slug'     =>  $prod->slug,
            'name'     =>  $prod->name,
            'description'     =>  $prod->description,
            'content'     =>  $prod->content,
            'price'     =>  $prod->price,
            'sale_price'     =>  $prod->sale_price,
            'quantity'     =>  $quantity,
            'category'     =>  $prod->category_id,
            'color' 	=> $color,
            'size'		=> $size,
        );
        echo json_encode($output);
	}
	public function update($id, Request $request)
	{
		$prod = Product::find($id);
		// dd($request->all());
        $prod->code = $request->code;
		$prod->name = $request->name;
		$prod->slug = $request->slug.'-'.time();
		$prod->description = $request->description;
		$prod->content = $request->edit_content;
		$prod->sale_price = $request->sale_price;
		$prod->price = $request->price;
		$prod->category_id = $request->category;
		// $prod->admin_created_id = $admin_created_id;
		$prod->admin_updated_id = Auth::guard('admin')->user()->id;
        $prod->save();

        $delete = ProductDetail::where('product_id',$id)->delete();
        $detail = new ProductDetail;
		$product_detail = [];
		
		foreach ($request->colors as $color) {
			foreach ($request->sizes as $size) {
				$product_detail[] = [
					'product_id' => $id,
					'quantity' => $request->quantity,
					'sold' => 0,
					'color_id' => $color,
					'size_id' => $size,
				];
			}
		}
		$detail->insert($product_detail); 

        return response()->json(['product' => $prod]);
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
