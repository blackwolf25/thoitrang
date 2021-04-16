<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Staff;
session_start();

class StaffController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function staff(){
    	$this->AuthLogin();
    	$all_staff = DB::table('tbl_admin')->where('admin_type','2')->orderby('tbl_admin.admin_id','desc')->get();
    	return view('admin.staff')->with(compact('all_staff'));
    }

    public function unactive_staff($admin_id){
        $this->AuthLogin();
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['admin_status'=>0]);
        Session::put('message','Tắt kích hoạt tài khoản này thành công.');
        return Redirect::to('staff');

    }
    public function active_staff($admin_id){
        $this->AuthLogin();
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['admin_status'=>1]);
        Session::put('message','Bật kích hoạt tài khoản này thành công.');
        return Redirect::to('staff');

    }

    public function delete_staff($admin_id){
        $this->AuthLogin();
        $staff = Staff::find($admin_id);
        if ($staff->admin_avatar !="trumstore.jpg") {
        unlink('public/uploads/images/user/'.$staff->admin_avatar);

        DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
        Session::put('message','Xóa tài khoản thành công.');
        return Redirect::to('staff');
    }
    DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
    Session::put('message','Xóa tài khoản thành công.');
    return Redirect::to('staff');
    }

    public function insert_staff_backend(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['admin_status'] = $request->staff_status;
        $data['admin_type'] = "2";
        $data['admin_email'] = $request->staff_email;
        $data['admin_password'] = md5($request->staff_password);
        $data['admin_name'] = $request->staff_name;
        $data['admin_dateofbirth'] = $request->staff_dateofbirth;
        $data['admin_phone'] = $request->staff_phone;
        $data['admin_add'] = $request->staff_add;
        
            DB::table('tbl_admin')->insert($data);
            Session::put('message','Thêm tài khoản thành công.');
            return Redirect::to('staff');
    
    }

    public function update_staff_backend(Request $request,$admin_id){
        $this->AuthLogin();
        $data = array();
        $data['admin_status'] = $request->staff_status;
        $data['admin_type'] = $request->staff_type;
        $data['admin_email'] = $request->staff_email;
        $data['admin_password'] = md5($request->staff_password);
        $data['admin_name'] = $request->staff_name;
        $data['admin_dateofbirth'] = $request->staff_dateofbirth;
        $data['admin_phone'] = $request->staff_phone;
        $data['admin_add'] = $request->staff_add;
        $get_image = $request->file('staff_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    if ($get_name_image !="trumstore.jpg") {
                    $staff = Staff::find($admin_id);
                        if ($staff->admin_avatar !="trumstore.jpg") {
                        unlink('public/uploads/images/user/'.$staff->admin_avatar);

                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/user',$new_image);
                    $data['admin_avatar'] = $new_image;
                    DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
                    Session::put('message','Cập nhật tài khoản thành công.');
                    return Redirect::to('staff'); 
                    }
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/user',$new_image);
                    $data['admin_avatar'] = $new_image;
                    DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
                    Session::put('message','Cập nhật tài khoản thành công.');
                    return Redirect::to('staff'); 
                }
            DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
            Session::put('message','Cập nhật tài khoản thành công.');
            return Redirect::to('staff') ;      
        }
            
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
        Session::put('message','Cập nhật tài khoản thành công.');
        return Redirect::to('staff');
    }


}
