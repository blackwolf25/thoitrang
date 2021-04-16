<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\CategoryProduct;

class CategoryProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_category_product(){
        $this->AuthLogin();
    	$all_category_product = DB::table('tbl_category_product')->orderBy('category_id','DESC')->paginate();
    	return view('admin.manage_category_product')->with(compact('all_category_product'));

    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_product_status;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['slug_category_product'] = to_slug($request->category_product_name);

        $get_image = $request->file('category_product_image');
       
        if($get_image){ 
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/product',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_product')->insert($data);
            Session::put('message','Thêm danh mục sản phẩm thành công.');
            return Redirect::to('manage-category-product');
        } else{
        $data['category_image'] = 'uiuy.png';

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục sản phẩm thành công.');
        return Redirect::to('manage-category-product');
    }
}
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Tắt kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('manage-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Bật kích hoạt danh mục sản phẩm thành công.');
        return Redirect::to('manage-category-product');

    }
    
    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_product_status;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['slug_category_product'] = to_slug($request->category_product_name);
        
        $get_image = $request->file('category_product_image');
       
        if($get_image){ 
        $cate = CategoryProduct::find($category_product_id);
        unlink('public/uploads/images/product/'.$cate->category_image);

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/product',$new_image);
            $data['category_image'] = $new_image;
            DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
            Session::put('message','Thêm danh mục sản phẩm thành công.');
            return Redirect::to('manage-category-product');
        } else{

        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công.');
        return Redirect::to('manage-category-product');
    }
}
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        $cate = CategoryProduct::find($category_product_id);
        unlink('public/uploads/images/product/'.$cate->category_image);
        
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công.');
        return Redirect::to('manage-category-product');
    }

    //FRONT END

    public function show_category_frontend(Request $request, $slug_category_product){

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $cate_product_1 = DB::table('tbl_category_product')->where('category_status','1')->where('slug_category_product',$slug_category_product)->orderby('category_id','desc')->get();

        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_product')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->leftjoin('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->where('tbl_category_product.slug_category_product',$slug_category_product)
        ->orderby('tbl_product.product_id','desc')->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();

        foreach($category_name as $key => $val){
                //seo 
                $meta_desc = $val->category_desc; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $image_og = url('public/uploads/images/product/'.$val->category_image);
                $url_canonical = $request->url();
                //--seo
                }

        return view('pages.show_category_product')->with('category',$cate_product)->with('category1',$cate_product_1)->with('brand',$brand_product)->with('slider',$slider)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);

    }
}
