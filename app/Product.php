<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_thumbnail_photo'];


    function relationCategoryToProduct(){
    	return $this->hasOne('App\Category','id','category_id');
    }
}
