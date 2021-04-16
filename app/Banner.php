<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'banner_name', 'banner_status', 'banner_image',  'banner_desc', 'link',  'banner_pos', 'banner_created_at', 'banner_updated_at'
    ];
    protected $primaryKey = 'banner_id';
 	protected $table = 'tbl_banner';
}
