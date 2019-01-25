<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Datatables;
use Validator;

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
       $products = Product::select('id','code','name','slug','description','sale_price','price','category_id','content');
       return Datatables::of($products)
       ->addColumn('action', function($product){
        return '<a class="btn btn-warning btn-edit" data-id="'.$product->id.'"​><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <button type="button" class="btn btn-info btn-show" data-id="'.$product->id.'"​><i class="fa fa-eye" aria-hidden="true"></i></button>
        <button class="btn btn-danger btn-delete" data-id="'.$product->id.'"​><i class="fa fa-times" aria-hidden="true"></i></button>';
    })->make(true);
   }
}
