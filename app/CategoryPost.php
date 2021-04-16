<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	 'category_desc','category_name', 'category_status', 'meta_keywords', 'slug_category_post', 'category_image', 'category_created_at', 'category_updated_at'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_post';
}
