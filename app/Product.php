<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Categories;
class Product extends Model
{
    //
     protected $guarded = [];
     protected $fillable = ['title','description','price','discount','status','total_price','thumbnail'];
     public function categories()
     {
     	return $this->belongsToMany('App\Categories','categories_product','product_id','Category_id');
     }
     //  public function category()
     // {
     // 	return $this->belongsToMany('App\Categories');
     // }

}

