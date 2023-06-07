<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	// using SoftDeletes
	use SoftDeletes;

	// database update security
    protected $fillable = ['category_name','category_photo'];
}
