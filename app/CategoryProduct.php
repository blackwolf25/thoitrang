<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
   public $timestamps = false;
    protected $fillable = [
    	 'category_image', 'meta_keywords', 'category_name', 'slug_category_product', 'category_desc', 'category_status',  'category_parent', 'category_created_at', 'category_updated_at'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_product';
}
