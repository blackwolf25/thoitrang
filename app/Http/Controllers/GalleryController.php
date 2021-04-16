<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
Use App\Gallery;
session_start();

class GalleryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function add_gallery($product_id){
        $this->AuthLogin();
        $pro_id = $product_id;

    	return view('admin.gallery')->with(compact('pro_id'));
    }

    public function select_gallery(Request $request){
        $product_id = $request->pro_id;
        $gallery = Gallery::where('product_id',$product_id)->get();
        $gallery_count = $gallery->count();
        $output = '<table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <form>
                    '.csrf_field().'
                  <tr style="text-align: center;">
                    <th>STT</th>
                    <th>Tên hình ảnh</th>
                    <th>Hình ảnh</th>
                    
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody>

        ';
        if ($gallery_count>0) {
            $i = 0;
            foreach ($gallery as $key => $gal) {
               $i++;
               $output.='
               
                <tr style="text-align: center;">
                    <td>'.$i.'</td>
                    <td contenteditable class="edit_gal_name" data-gal_id="'.$gal->gallery_id.'">'.$gal->gallery_name.'</td>
                    <td><img src ="'.url('public/uploads/images/gallery/'.$gal->gallery_image).'" class="img-thumbnails" width="100px" height="100px">
                        <input type="file" class="file_image" data-gal_id="'.$gal->gallery_id.'" id="file-'.$gal->gallery_id.'">
                    </td>
                    
                    <td><button type="button" data-gal_id="'.$gal->gallery_id.'" class="btn btn-danger delete-gallery"><i class="fa fa-trash"></i></button></td>
                    
                  </tr>
                
               ';
            }
        }else{
             $output.='<tr style="text-align: center;">
                    <td colspan = "4">Sản phẩm này chưa có thư viện ảnh.</td>
                  </tr>
               ';
        }
        $output.='</form>
                  </tbody>
                </table>
        ';
        echo $output;
    }

    public function insert_gallery(Request $request,$pro_id){
        $get_image = $request->file('file');
        if ($get_image) {
            foreach ($get_image as $image) {
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.time().'.'.$image->getClientOriginalExtension();
                $image->move('public/uploads/images/gallery',$new_image);

                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $pro_id;
                $gallery->save();
                Session::put('message','Thêm hình ảnh thư viện thành công.');
            }
        }
        
                return redirect()->back();
    }

public function update_gallery_name(Request $request){
    $gal_id = $request->gal_id;
    $gal_text = $request->gal_text;
    $gallery = Gallery::find($gal_id);
    $gallery->gallery_name = $gal_text;
    $gallery->save();
    Session::put('message','Cập nhật tên hình ảnh thư viện thành công.');
}

public function delete_gallery(Request $request){
    $gal_id = $request->gal_id;
    $gallery = Gallery::find($gal_id);
    unlink('public/uploads/images/gallery/'.$gallery->gallery_image);
    $gallery->delete();
}

public function update_gallery(Request $request){
    $get_image = $request->file('file');
        if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/images/gallery',$new_image);

                $gallery = Gallery::find($gal_id);
                unlink('public/uploads/images/gallery/'.$gallery->gallery_image);
                $gallery->gallery_image = $new_image;
                
                $gallery->save();
                Session::put('message','Cập nhật hình ảnh thư viện thành công.');
            
        }
}



}
