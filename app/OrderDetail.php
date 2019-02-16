<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';
    protected $fillable =['id','order_id','order_code','product_id','product_detail_id','quantity','sub_total'];
}
