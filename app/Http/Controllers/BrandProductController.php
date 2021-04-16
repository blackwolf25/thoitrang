<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Brand;

class BrandProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_brand_product(){
        $this->AuthLogin();
    	$all_brand_product = DB::table('tbl_brand_product')->orderBy('brand_id','DESC')->paginate();
    	return view('admin.manage_brand_product')->with(compact('all_brand_product'));

    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        $data['brand_slug'] = to_slug($request->brand_product_name);
        $get_image = $request->file('brand_image');
      
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/brand',$new_image);
            $data['brand_image'] = $new_image;
            DB::table('tbl_brand_product')->insert($data);
            Session::put('message','Thêm Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Thêm Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');

    }

    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Tắt kích hoạt Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');

    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Bật kích hoạt Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');

    }
    
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        $data['brand_slug'] = to_slug($request->brand_product_name);
        $get_image = $request->file('brand_image');

        
        if($get_image){
            $brand = Brand::find($brand_product_id);
            unlink('public/uploads/images/brand/'.$brand->brand_image);

                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/images/brand',$new_image);
                    $data['brand_image'] = $new_image;
                    DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
                    Session::put('message','Cập nhật Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
                    return Redirect::to('manage-brand-product');
        }
            
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
        Session::put('message','Cập nhật Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');
        
    }


    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        $brand = Brand::find($brand_product_id);
        unlink('public/uploads/images/brand/'.$brand->brand_image);

        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa Nhà sản xuất hay nhà sản xuất sản phẩm thành công.');
        return Redirect::to('manage-brand-product');
    }

    //FRONT END

    public function show_brand_frontend(Request $request, $brand_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        
        $brand_by_id = DB::table('tbl_product')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->leftjoin('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->where('tbl_brand_product.brand_slug',$brand_slug)
        ->orderby('tbl_product.product_id','desc')->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_slug',$brand_slug)->limit(1)->get();

        foreach($brand_name as $key => $val){
            //seo 
            $meta_desc = $val->brand_desc; 
            $meta_keywords = $val->brand_desc;
            $meta_title = $val->brand_name;
            $image_og = url('public/uploads/images/brand/'.$val->brand_image);
            $url_canonical = $request->url();
            //--seo
        }

        return view('pages.show_brand_product')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('slider',$slider)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);

    }





}
