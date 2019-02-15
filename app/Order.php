<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable =['id','code','customer_id','name','email','address','mobile','total','status'];
}
