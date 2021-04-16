<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'category_id', 'post_name','post_tags', 'post_desc', 'post_content', 'post_image', 'post_slug', 'post_status', 'key_words',  'post_created_at', 'post_updated_at', 'post_noibat', 'post_author'
    ];
    protected $primaryKey = 'post_id';
 	protected $table = 'tbl_post';
}
