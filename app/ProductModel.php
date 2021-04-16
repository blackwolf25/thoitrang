<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'product_name', 'product_tags', 'product_quantity', 'product_sold', 'product_slug', 'category_id', 'create_at', 'update_at', 'brand_id', 'product_desc', 'product_content', 'product_price', 'product_nhap', 'product_image', 'product_status', 'product_file', 'product_exp', 'product_mfg', 'product_noibat'
    ];
    protected $primaryKey = 'product_id';
 	protected $table = 'tbl_product';
}
