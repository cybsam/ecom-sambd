<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['blog_image'];


    function blogTo_blogcategory(){
    	return $this -> hasOne('App\BlogCategory','id','blog_category');
    }
}
