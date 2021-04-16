<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'contact_name', 'contact_email', 'contact_content','contact_phone', 'contact_rep', 'contact_created_at', 'contact_status', 'contact_updated_at'
    ];
    protected $primaryKey = 'contact_id';
 	protected $table = 'tbl_contact';
}
