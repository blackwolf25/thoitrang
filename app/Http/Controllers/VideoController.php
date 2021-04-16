<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Video;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use DB;


class VideoController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manage_video(){
        $all_video= DB::table('tbl_videos')->get();
        return view('admin.manage_video')->with(compact('all_video'));
    }
    
    public function unactive_video($video_slug){
        $this->AuthLogin();
        DB::table('tbl_videos')->where('video_slug',$video_slug)->update(['video_status'=>0]);
        Session::put('message','Tắt kích hoạt video thành công.');
        return Redirect::to('/manage-video');

    }
    public function active_video($video_slug){
        $this->AuthLogin();
        DB::table('tbl_videos')->where('video_slug',$video_slug)->update(['video_status'=>1]);
        Session::put('message','Bật kích hoạt video thành công.');
        return Redirect::to('manage-video');

    }

    public function insert_video(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['video_title'] = $request->video_title;
        $data['video_desc'] = $request->video_desc;
        $data['video_status'] = $request->video_status;
        $data['video_slug'] = to_slug($request->video_title);

        $data['video_link'] =substr($request->video_link,32);
        
        $get_image = $request->file('video_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/video', $new_image);

            $data['video_image'] = $new_image;
            DB::table('tbl_videos')->insert($data);
            Session::put('message','Thêm video thành công.');
            return Redirect::to('manage-video');
         }else{
            $data['video_image'] = '';
            DB::table('tbl_videos')->insert($data);
            Session::put('message','Thêm video thành công.');
            return Redirect::to('manage-video');
        }
    }
    public function delete_video(Request $request, $video_id){
        $video = Video::find($video_id);
        unlink('public/uploads/images/video/'.$video->video_image);
        
        $video->delete();
        Session::put('message','Xóa video thành công.');
        return redirect()->back();
    }

    public function update_video(Request $request,$video_id){
        $this->AuthLogin();
        $data = array();
        $data['video_title'] = $request->video_title;
        $data['video_status'] = $request->video_status;
        $data['video_desc'] = $request->video_desc;
        $data['video_link'] =substr($request->video_link,32);

        $data['video_slug'] = to_slug($request->video_title);
        $get_image = $request->file('video_image');

        if($get_image){
            $video = Video::find($video_id);
            unlink('public/uploads/images/video/'.$video->video_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/video', $new_image);

            $data['video_image'] = $new_image;  
            DB::table('tbl_videos')->where('video_id',$video_id)->update($data);
            Session::put('message','Cập nhật video thành công.');
            return Redirect::to('manage-video');
        }else{
            DB::table('tbl_videos')->where('video_id',$video_id)->update($data);
            Session::put('message','Cập nhật video thành công.');
            return Redirect::to('manage-video');
        }
    }

}
