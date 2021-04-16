<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Banner;

class BannerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_banner(){
    	$all_banner= DB::table('tbl_banner')->paginate();
    	return view('admin.manage_banner')->with(compact('all_banner'));
    }
    
    public function unactive_banner($banner_id){
        $this->AuthLogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>0]);
        Session::put('message','Tắt kích hoạt banner thành công.');
        return Redirect::to('manage-banner');

    }
    public function active_banner($banner_id){
        $this->AuthLogin();
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>1]);
        Session::put('message','Bật kích hoạt banner thành công.');
        return Redirect::to('manage-banner');

    }

    public function insert_banner(Request $request){
    	$this->AuthLogin();
    	$data = array();
    	$data['banner_name'] = $request->banner_name;
        $data['banner_status'] = $request->banner_status;
        $data['banner_desc'] = $request->banner_desc;
        $data['banner_pos'] = $request->banner_pos;
        $data['link'] = $request->link;
        if(  $data['link'] ){
            $request->link;
        } $data['link'] = "http://localhost:81/thoitrang/trang-chu";

       	$get_image = $request->file('banner_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/banner', $new_image);

            $data['banner_image'] = $new_image;

           	DB::table('tbl_banner')->insert($data);
            Session::put('message','Thêm banner thành công.');
            return Redirect::to('manage-banner');
        }else{
        	Session::put('message','Làm ơn thêm hình ảnh.');
    		return Redirect::to('manage-banner');
        }
       	
    }
    public function delete_banner(Request $request, $banner_id){
        $banner = banner::find($banner_id);
        unlink('public/uploads/images/banner/'.$banner->banner_image);
        
        $banner->delete();
        Session::put('message','Xóa banner thành công.');
        return redirect()->back();
    }

    public function update_banner(Request $request,$banner_id){
        $this->AuthLogin();
        $data = array();
        $data['banner_name'] = $request->banner_name;
        $data['banner_status'] = $request->banner_status;
        $data['banner_desc'] = $request->banner_desc;
        $data['banner_pos'] = $request->banner_pos;
        $data['link'] = $request->link;
        $get_image = $request->file('banner_image');
        
        if($get_image){
                    $banner = Banner::find($banner_id);
                    unlink('public/uploads/images/banner/'.$banner->banner_image);

                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/banner',$new_image);
                    $data['banner_image'] = $new_image;
                    DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data);
                    Session::put('message','Cập nhật banner thành công.');
                    return Redirect::to('manage-banner');
        }
            
        DB::table('tbl_banner')->where('banner_id',$banner_id)->update($data);
        Session::put('message','Cập nhật banner thành công.');
        return Redirect::to('manage-banner');
    }
}
