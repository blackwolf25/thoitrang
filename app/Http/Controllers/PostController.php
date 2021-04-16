<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Post;
use App\CategoryPost;
class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function show_post(){
        $this->AuthLogin();
    	$all_category_post = DB::table('tbl_category_post')->orderBy('category_id','DESC')->paginate(10);
    	$all_post = DB::table('tbl_post')->join('tbl_category_post','tbl_category_post.category_id','=','tbl_post.category_id')->orderBy('post_id','DESC')->paginate(20);
    	return view('admin.manage_post')->with(compact('all_category_post'))->with(compact('all_post'));

    }
    public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_post_name;
        $data['category_desc'] = $request->category_post_name;
        $data['category_status'] = $request->category_post_status;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['slug_category_post'] = to_slug($request->category_post_name);

        $get_image = $request->file('category_post_image');
       
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/post',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_post')->insert($data);
            Session::put('message','Thêm danh mục bài viết thành công.');
            return Redirect::to('manage-post');
        } else{
        $data['category_image'] = 'logo.png';
        DB::table('tbl_category_post')->insert($data);
        Session::put('message','Thêm danh mục bài biết thành công.');
        return Redirect::to('manage-post');
    }
    }
    public function unactive_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_id',$category_post_id)->update(['category_status'=>0]);
        Session::put('message','Tắt kích hoạt danh mục bài biết thành công.');
        return Redirect::to('manage-post');

    }
    public function active_category_post($category_post_id){
        $this->AuthLogin();
        DB::table('tbl_category_post')->where('category_id',$category_post_id)->update(['category_status'=>1]);
        Session::put('message','Bật kích hoạt danh mục bài biết thành công.');
        return Redirect::to('manage-post');

    }
    
    public function update_category_post(Request $request,$category_post_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_post_name;
        $data['category_desc'] = $request->category_post_name;
        $data['category_status'] = $request->category_post_status;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['slug_category_post'] = to_slug($request->category_post_name);
        $get_image = $request->file('category_post_image');
       
        if($get_image){
            $category_post = CategoryPost::find($category_post_id);
            unlink('public/uploads/images/post/'.$category_post->category_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/post',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_post')->where('category_id',$category_post_id)->update($data);
            Session::put('message','Cập nhật danh mục bài viết thành công.');
            return Redirect::to('manage-post');
        } else{
        DB::table('tbl_category_post')->where('category_id',$category_post_id)->update($data);
        Session::put('message','Cập nhật danh mục bài biết thành công.');
        return Redirect::to('manage-post');
    }
}
    public function delete_category_post($category_post_id){
        $this->AuthLogin();
        $category_post = CategoryPost::find($category_post_id);
        unlink('public/uploads/images/post/'.$category_post->category_image);

        DB::table('tbl_category_post')->where('category_id',$category_post_id)->delete();
        Session::put('message','Xóa danh mục bài biết thành công.');
        return Redirect::to('manage-post');
    }

    public function post_save_post(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['post_name'] = $request->post_name;
    	$data['post_desc'] = $request->post_name;
        $data['category_id'] = $request->post_cate;
        $data['post_status'] = $request->post_status;
        $data['post_content'] = $request->post_content;
        $data['post_tags'] = $request->post_tags;
        $data['key_words'] = $request->meta_keywords;
        $data['post_slug'] = to_slug($request->post_name);
        $data['post_noibat'] = $request->post_noibat;
        $data['post_author'] = $request->post_author;

        $get_image = $request->file('post_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/post',$new_image);
            $data['post_image'] = $new_image;
            DB::table('tbl_post')->insert($data);
            Session::put('message','Thêm bài viết thành công.');
            return Redirect::to('manage-post');
        }
        
    	DB::table('tbl_post')->insert($data);
    	Session::put('message','Thêm bài viêt thành công');
    	return Redirect::to('manage-post');
    }

    public function unactive_post($post_id){
        $this->AuthLogin();
        DB::table('tbl_post')->where('post_id',$post_id)->update(['post_status'=>0]);
        Session::put('message','Tắt kích hoạt bài viết thành công.');
        return Redirect::to('manage-post');

    }

    public function active_post($post_id){
        $this->AuthLogin();
        DB::table('tbl_post')->where('post_id',$post_id)->update(['post_status'=>1]);
        Session::put('message','Bật kích hoạt bài viết thành công.');
        return Redirect::to('manage-post');
    }

    public function unnoibat_post($post_id){
        $this->AuthLogin();
        DB::table('tbl_post')->where('post_id',$post_id)->update(['post_noibat'=>0]);
        Session::put('message','Tắt kích hoạt bài viết nổi bật thành công.');
        return Redirect::to('manage-post');

    }

    public function noibat_post($post_id){
        $this->AuthLogin();
        DB::table('tbl_post')->where('post_id',$post_id)->update(['post_noibat'=>1]);
        Session::put('message','Bật kích hoạt bài viết nổi bật thành công.');
        return Redirect::to('manage-post');
    }

    public function update_post(Request $request,$post_id){
         $this->AuthLogin();
        $data = array();
       	$data['post_name'] = $request->post_name;
    	$data['post_desc'] = $request->post_name;
        $data['category_id'] = $request->post_cate;
        $data['post_status'] = $request->post_status;
        $data['post_content'] = $request->post_content;
        $data['key_words'] = $request->meta_keywords;
        $data['post_tags'] = $request->post_tags;
        $data['post_slug'] = to_slug($request->post_name);
        $data['post_noibat'] = $request->post_noibat;
        $data['post_author'] = $request->post_author;
        $get_image = $request->file('post_image');

        
        if($get_image){
        $post = Post::find($post_id);
        unlink('public/uploads/images/post/'.$post->post_image);

                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/post',$new_image);
                    $data['post_image'] = $new_image;
                    DB::table('tbl_post')->where('post_id',$post_id)->update($data);
                    Session::put('message','Cập nhật bài viết thành công.');
                    return Redirect::to('manage-post');
        }
            
        DB::table('tbl_post')->where('post_id',$post_id)->update($data);
        Session::put('message','Cập nhật bài viết thành công.');
        return Redirect::to('manage-post');
    }
    
    public function delete_post($post_id){
        $this->AuthLogin();
        $post = Post::find($post_id);
        unlink('public/uploads/images/post/'.$post->post_image);
        
        DB::table('tbl_post')->where('post_id',$post_id)->delete();
        Session::put('message','Xóa bài viết thành công.');
        return Redirect::to('manage-post');
    }

    


}
