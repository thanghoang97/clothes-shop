<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'product_detail';
    protected $fillable = ['id','product_id','quantity','sold','color_id','size_id'];

    public function product()
    {
    	return $this->belongsto('App\Product');
    }
}
