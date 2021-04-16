<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Slider;

class SliderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_slider(){
    	$all_slider= DB::table('tbl_slider')->paginate();
    	return view('admin.manage_slider')->with(compact('all_slider'));
    }
    
    public function unactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','Tắt kích hoạt slider thành công.');
        return Redirect::to('manage-slider');

    }
    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Bật kích hoạt slider thành công.');
        return Redirect::to('manage-slider');

    }

    public function insert_slider(Request $request){
    	$this->AuthLogin();
    	$data = array();
    	$data['slider_name'] = $request->slider_name;
        $data['slider_status'] = $request->slider_status;
        $data['slider_desc'] = $request->slider_desc;
        $data['link'] = $request->link;
        if(  $data['link'] ){
            $request->link;
        } $data['link'] = "http://localhost:81/thoitrang/trang-chu";

       	$get_image = $request->file('slider_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/slider', $new_image);

            $data['slider_image'] = $new_image;

           	DB::table('tbl_slider')->insert($data);
            Session::put('message','Thêm slider thành công.');
            return Redirect::to('manage-slider');
        }else{
        	Session::put('message','Làm ơn thêm hình ảnh.');
    		return Redirect::to('manage-slider');
        }
       	
    }
    public function delete_slider(Request $request, $slider_id){
        $slider = Slider::find($slider_id);
        unlink('public/uploads/images/slider/'.$slider->slider_image);
        $slider->delete();
        Session::put('message','Xóa slider thành công.');
        return redirect()->back();
    }

    public function update_slider(Request $request,$slider_id){
        $this->AuthLogin();
        $data = array();
        $data['slider_name'] = $request->slider_name;
        $data['slider_status'] = $request->slider_status;
        $data['slider_desc'] = $request->slider_desc;
        $data['link'] = $request->link;
        $get_image = $request->file('slider_image');
        
        if($get_image){
                    $slider = Slider::find($slider_id);
                    unlink('public/uploads/images/slider/'.$slider->slider_image);

                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/slider',$new_image);
                    $data['slider_image'] = $new_image;
                    DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
                    Session::put('message','Cập nhật slider thành công.');
                    return Redirect::to('manage-slider');
        }
            
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
        Session::put('message','Cập nhật slider thành công.');
        return Redirect::to('manage-slider');
    }
}
