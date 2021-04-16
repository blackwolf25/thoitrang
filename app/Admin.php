<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'admin_type', 'admin_status', 'admin_email', 'admin_password', 'admin_name', 'admin_dateofbirth', 'admin_phone', 'admin_add','admin_avatar', 'created_at', 'updated_at','acount_status'
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';

}
