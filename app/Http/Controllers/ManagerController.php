<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Manager;
session_start();

class ManagerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manager(){
    	$this->AuthLogin();
    	$all_manager = DB::table('tbl_admin')->where('admin_type','1')->orderby('tbl_admin.admin_id','desc')->get();
    	return view('admin.manager')->with(compact('all_manager'));
    }

    public function unactive_manager($admin_id){
        $this->AuthLogin();
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['admin_status'=>0]);
        Session::put('message','Tắt kích hoạt tài khoản này thành công.');
        return Redirect::to('manager');

    }
    public function active_manager($admin_id){
        $this->AuthLogin();
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update(['admin_status'=>1]);
        Session::put('message','Bật kích hoạt tài khoản này thành công.');
        return Redirect::to('manager');

    }

    public function delete_manager($admin_id){
        $this->AuthLogin();
        $manager = Manager::find($admin_id);
        if ($manager->admin_avatar !="trumstore.jpg") {
        unlink('public/uploads/images/user/'.$manager->admin_avatar);

        DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
        Session::put('message','Xóa tài khoản thành công.');
        return Redirect::to('manager');
    }

    DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
    Session::put('message','Xóa tài khoản thành công.');
    return Redirect::to('manager');
    }

    public function insert_manager_backend(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['admin_status'] = $request->manager_status;
        $data['admin_type'] = "1";
        $data['admin_email'] = $request->manager_email;
        $data['admin_password'] = md5($request->manager_password);
        $data['admin_name'] = $request->manager_name;
        $data['admin_dateofbirth'] = $request->manager_dateofbirth;
        $data['admin_phone'] = $request->manager_phone;
        $data['admin_add'] = $request->manager_add;
        
            DB::table('tbl_admin')->insert($data);
            Session::put('message','Thêm tài khoản thành công.');
            return Redirect::to('manager');
    
    }

    public function update_manager_backend(Request $request,$admin_id){
        $this->AuthLogin();
        $data = array();
        $data['admin_status'] = $request->manager_status;
        $data['admin_type'] = $request->manager_type;
        $data['admin_email'] = $request->manager_email;
        $data['admin_password'] = md5($request->manager_password);
        $data['admin_name'] = $request->manager_name;
        $data['admin_dateofbirth'] = $request->manager_dateofbirth;
        $data['admin_phone'] = $request->manager_phone;
        $data['admin_add'] = $request->manager_add;
        $get_image = $request->file('manager_image');
        
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    if ($get_name_image !="trumstore.jpg") {

                        $manager = Manager::find($admin_id);
                        if ($manager->admin_avatar !="trumstore.jpg") {

                            unlink('public/uploads/images/user/'.$manager->admin_avatar);

                            $name_image = current(explode('.',$get_name_image));
                            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                            $get_image->move('public/uploads/images/user',$new_image);
                            $data['admin_avatar'] = $new_image;
                            DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
                            Session::put('message','Cập nhật tài khoản thành công.');
                            return Redirect::to('manager');
                         }
                         
                        $name_image = current(explode('.',$get_name_image));
                            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                            $get_image->move('public/uploads/images/user',$new_image);
                            $data['admin_avatar'] = $new_image; 
                        DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
                        Session::put('message','Cập nhật tài khoản thành công.');
                        return Redirect::to('manager');
                    }
                    DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
                    Session::put('message','Cập nhật tài khoản thành công.');
                    return Redirect::to('manager');
        }
            
        DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
        Session::put('message','Cập nhật tài khoản thành công.');
        return Redirect::to('manager');
    }


}
