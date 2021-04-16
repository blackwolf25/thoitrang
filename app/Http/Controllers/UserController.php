<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Session;

class UserController extends Controller
{
    public function index(){

    	$admin = Admin::with('roles')->orderBy('admin_id','DESC');

    	return view('admin.all_users')->with(compact('admin'));
    }




}
