<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'document_name', 'document_desc', 'document_file', 'document_slug', 'document_cate', 'document_date', 'document_status', 'document_image', 'document_created_at'
    ];
    protected $primaryKey = 'document_id';
 	protected $table = 'tbl_document';
}
