<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();


class CustomerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function customer(){
    	$this->AuthLogin();
        $admin = DB::table('tbl_admin')->orderby('admin_id','desc')->get(); 
    	$all_customer = DB::table('tbl_customers')
        ->join('tbl_admin','tbl_admin.admin_id','=','tbl_customers.admin_id')
        ->orderby('tbl_customers.customer_id','desc')->paginate();
        $all_customer_new = DB::table('tbl_customers')
        ->join('tbl_admin','tbl_admin.admin_id','=','tbl_customers.admin_id')->where('customer_vip',0)
        ->orderby('tbl_customers.customer_id','desc')->paginate();
        $all_customer_thuong = DB::table('tbl_customers')
        ->join('tbl_admin','tbl_admin.admin_id','=','tbl_customers.admin_id')->where('customer_vip',1)
        ->orderby('tbl_customers.customer_id','desc')->paginate();
        $all_customer_vip = DB::table('tbl_customers')
        ->join('tbl_admin','tbl_admin.admin_id','=','tbl_customers.admin_id')->where('customer_vip',2)
        ->orderby('tbl_customers.customer_id','desc')->paginate();

    	return view('admin.customer')->with(compact('all_customer','admin','all_customer_new','all_customer_thuong','all_customer_vip'));
    }

    public function unactive_customer($customer_id){
        $this->AuthLogin();
        DB::table('tbl_customers')->where('customer_id',$customer_id)->update(['customer_status'=>0]);
        Session::put('message','Tắt kích hoạt tài khoản này thành công.');
        return Redirect::to('customer');

    }
    public function active_customer($customer_id){
        $this->AuthLogin();
        DB::table('tbl_customers')->where('customer_id',$customer_id)->update(['customer_status'=>1]);
        Session::put('message','Bật kích hoạt tài khoản này thành công.');
        return Redirect::to('customer');

    }

    public function delete_customer($customer_id){
        $this->AuthLogin();
        DB::table('tbl_customers')->where('customer_id',$customer_id)->delete();
        Session::put('message','Xóa tài khoản thành công.');
        return Redirect::to('customer');
    }

    public function insert_customer_backend(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['customer_status'] = $request->customer_status;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_name'] = $request->customer_name;
        $data['customer_dateofbirth'] = $request->customer_dateofbirth;
        $data['customer_add'] = $request->customer_add;
        $data['customer_phone'] = $request->customer_phone;
        $data['admin_id'] = $request->admin_id;
        $data['customer_vip'] = $request->customer_vip;
            DB::table('tbl_customers')->insert($data);
            Session::put('message','Thêm tài khoản thành công.');
            return Redirect::to('customer');
    
    }

    public function update_customer_backend(Request $request,$customer_id){
        $this->AuthLogin();
        $data = array();
        $data['customer_status'] = $request->customer_status;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_name'] = $request->customer_name;
        $data['customer_dateofbirth'] = $request->customer_dateofbirth;
        $data['customer_add'] = $request->customer_add;
        $data['customer_phone'] = $request->customer_phone;
        $data['admin_id'] = $request->admin_id; 
        $data['customer_vip'] = $request->customer_vip;
            DB::table('tbl_customers')->where('customer_id',$customer_id)->update($data);
            Session::put('message','Cập nhật tài khoản thành công.');
            return Redirect::to('customer');
        }



}
