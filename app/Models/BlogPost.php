<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BlogCategory;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogcategory(){
    	return $this->hasOne(BlogCategory::class,'id','blog_category_id');
    }
}
