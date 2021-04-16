<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public $timestamps = false; 
    protected $fillable = [
    	'video_title', 'video_slug','video_link','video_desc','video_status','video_image', 'video_created_at'
    ];
    protected $primaryKey = 'video_id';
 	protected $table = 'tbl_videos';
}