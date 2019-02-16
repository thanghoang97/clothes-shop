<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Datatables;
use Validator;
use Auth;
use App\ProductDetail;
use App\Category;
use App\Color;
use App\Size;
class ProductDetailManagerController extends Controller
{
	public function getDetail($product_id,$btn_id)
	{
		$categories = Category::all();
		$colors = Color::all();
		$sizes = Size::all();
		$details = ProductDetail::where('product_id',$product_id)->orderBy('id','desc')->get();
		return Datatables::of($details)
		->addColumn('action',function($details){
			return '
			<a class="btn btn-warning detail-edit" data-id="'.$details->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
			<button class="btn btn-danger detail-delete" data-id="'.$details->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
		})->setRowClass(function($details) use($btn_id){
			return $details->id ==	$btn_id ? 'alert-warning' : '';
		})->editColumn('color_id',function($details) use($colors){
			foreach($colors as $color){
				if($color->id === $details->color_id){
					return $color->name;
				}
			}
		})->editColumn('size_id',function($details) use($sizes){
			foreach($sizes as $size){
				if($size->id === $details->size_id){
					return $size->name;
				}
			}
		})->make(true);		
	}
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'quantity' => 'required|max:10',
		]);
		$errors = array();
		$success = '';
		if($validator->fails()){
			foreach ($validator->messages()->getMessages() as $value => $messages) {
				$errors[] = $messages;
			}
			return response()->json(['errors'=>$errors]);
		}else{
			$test = ProductDetail::where([['color_id',$request->color],['size_id',$request->size],['product_id',$request->product_id]])->first();
		// dd($test[0]->quantity);
			if(empty($test))
			{
				$detail = new ProductDetail;
				$detail->product_id = $request->product_id;
				$detail->quantity = $request->quantity;
				$detail->size_id = $request->size;
				$detail->color_id = $request->color;
				$detail->save();
			}
			if(!empty($test))
			{
				$oldQuantity = $test->quantity;
				$id = $test->id;
				$detail = ProductDetail::find($id);
				$detail->quantity = $oldQuantity + $request->quantity;
				$detail->update();
			}
			return response()->json(['detail' => $detail]);
		}
	}
	public function destroy(Request $request)
	{
    	// dd($request->id);
		$prod = ProductDetail::find($request->id)->delete();
        // $delete = ProductDetail::where('product_id',$request->input('id'))->delete();
        // if($prod->delete())
        // {
		echo 'Data Deleted';
        // }
	}
	public function edit(Request $request)
	{
		// $id = $request->input('id');
		$detail = ProductDetail::find($request->id);
        // dd($detail);
		$output = array(
			'quantity'  =>  $detail->quantity,
			'color' 	=> $detail->color_id,
			'size'		=> $detail->size_id,
		);
		echo json_encode($output);
	}
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(),[
			'quantity' => 'required|max:10',
		]);
		$errors = array();
		$success = '';
		if($validator->fails()){
			foreach ($validator->messages()->getMessages() as $value => $messages) {
				$errors[] = $messages;
			}
			return response()->json(['errors'=>$errors]);
		}else{
			$detail = ProductDetail::find($request->id);
			$detail->quantity = $request->quantity;
			$detail->size_id = $request->size;
			$detail->color_id = $request->color;
			$detail->save();
			return response()->json(['detail' => $detail]);
		}
	}
}
