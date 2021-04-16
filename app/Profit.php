<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    
    public $timestamps = false;
    protected $fillable = [
    	'profit_content', 'profit_money', 'profit_date'
    ];
    protected $primaryKey = 'profit_id';
 	protected $table = 'tbl_profit';
}
