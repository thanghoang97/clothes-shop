<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id','name','slug','parent_id','top','left','description'];

    public function product()
    {
    	return $this->hasMany('App\Product');
    }
}
