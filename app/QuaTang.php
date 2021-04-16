<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuaTang extends Model
{
   	public $timestamps = false; //set time to false
    protected $fillable = [
    	'quatang_ten','quatang_soluong','quatang_gia'
    ];
    protected $primaryKey = 'quatang_id';
 	protected $table = 'tbl_quatang';
}
