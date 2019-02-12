<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =['id','code','name','slug','description','sale_price','price','category_id','content','admin_created_id','admin_updated_id'];

    public function details()
    {
    	return $this->hasMany('App\ProductDetail');
    }
    public function category()
    {
    	return $this->belongsto('App\Category');
    }
}
