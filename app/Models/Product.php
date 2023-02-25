<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function brand(){
    	return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function category(){
    	return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subcategory(){
    	return $this->belongsTo(SubCategory::class,'subcategory_id','id');
    }

    public function subsubcategory(){
    	return $this->belongsTo(SubSubCategory::class,'subsubcategory_id','id');
    }
}
