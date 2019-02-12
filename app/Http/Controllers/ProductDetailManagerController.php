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
		// dd($btn_id);
		$categories = Category::all();
		$colors = Color::all();
		$sizes = Size::all();
		$details = ProductDetail::where('product_id',$product_id)->get();
		// array_push($details[0], $btn_id);
		// $details->setAttribute('btn_id','dsa');
		// $details->put('btn_id',$btn_id);
		// dd($details->id);
		return Datatables::of($details)
		->addColumn('action',function($details){
		// dd($details->id);
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
		$detail = new ProductDetail;
		// dd($request->all());
		$detail->product_id = $request->product_id;
		$detail->quantity = $request->quantity;
		$detail->size_id = $request->size;
		$detail->color_id = $request->color;
		$detail->save();
		return response()->json(['detail' => $detail]);
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
		$detail = ProductDetail::find($request->id);
		$detail->quantity = $request->quantity;
		$detail->size_id = $request->size;
		$detail->color_id = $request->color;
		$detail->save();
		return response()->json(['detail' => $detail]);

	}
}
