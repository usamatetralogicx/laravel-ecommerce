<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use Illuminate\Database\Eloquent\SoftDeletes;
class Categories extends Model
{
    //
     use SoftDeletes;
     protected $guarded = [];
     protected $fillable = ['title','discription'];
     protected $dates = ['deleted_at'];
           public function product()
     {
     	return $this->belongsToMany('App\Product');
     }
     #category to category relationship
     public function childrens()
     {
     	return $this->belongsToMany('App\Categories','category_parent','Category_id','parent_id',);
     }

}

