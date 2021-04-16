<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDocument extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'category_name','category_desc', 'category_slug', 'category_image', 'document_status', 'created_at'
    ];
    protected $primaryKey = 'category_id';
 	protected $table = 'tbl_category_document';
}
