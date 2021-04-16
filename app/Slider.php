<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'slider_name', 'slider_status', 'slider_image',  'slider_desc', 'link', 'slider_created_at', 'slider_updated_at'
    ];
    protected $primaryKey = 'slider_id';
 	protected $table = 'tbl_slider';
}
