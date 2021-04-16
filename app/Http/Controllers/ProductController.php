<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Product;
Use App\Gallery;

use App\Imports\ExcelImports;
use App\Exports\ExcelExports;
use Excel;
use ProductModel;

class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    
    public function manage_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->paginate(20);
    	return view('admin.manage_product')->with(compact('all_product'))->with(compact('cate_product'))->with(compact('brand_product'));
    }

    public function post_save_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_noibat'] = $request->product_noibat;
        $data['product_mfg'] = $request->product_mfg;
        $data['product_exp'] = $request->product_exp;
        $data['product_nhap'] = $request->product_nhap;
        $data['product_slug'] = to_slug($request->product_name);
        $get_image = $request->file('product_image');

        $get_file = $request->file('product_file');
        
        if($get_file){
            $get_name_file = $get_file->getClientOriginalName();
            $name_file = current(explode('.',$get_name_file));
            $new_file =  $name_file.time().'.'.$get_file->getClientOriginalExtension();
            $get_file->move('public/uploads/files/',$new_file);
            $data['product_file'] = $new_file;
        }
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công.');
            return Redirect::to('manage-product');
        }

    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('manage-product');
    }

    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Tắt kích hoạt sản phẩm thành công.');
        return Redirect::to('manage-product');

    }

    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Bật kích hoạt sản phẩm thành công.');
        return Redirect::to('manage-product');
    }

    public function unnoibat_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_noibat'=>0]);
        Session::put('message','Tắt kích hoạt sản phẩm nổi bật thành công.');
        return Redirect::to('manage-product');
    }

    public function noibat_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_noibat'=>1]);
        Session::put('message','Bật kích hoạt sản phẩm nổi bật thành công.');
        return Redirect::to('manage-product');
    }


    public function update_product(Request $request,$product_id){
         $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_noibat'] = $request->product_noibat;
        $data['product_nhap'] = $request->product_nhap;
        $data['product_mfg'] = $request->product_mfg;
        $data['product_exp'] = $request->product_exp;
        
        $data['product_slug'] = to_slug($request->product_name);
        $get_image = $request->file('product_image');
        $get_file = $request->file('product_file');
        if($get_file){
            $product_document = Product::find($product_id);
            if ($product_document->product_file) {
                unlink('public/uploads/files/'.$product_document->product_file);
            }

            $get_name_file = $get_file->getClientOriginalName();
            $name_file = current(explode('.',$get_name_file));
            $new_file =  $name_file.time().'.'.$get_file->getClientOriginalExtension();
            $get_file->move('public/uploads/files/',$new_file);
            $data['product_file'] = $new_file;
        }
        if($get_image){
            $product_image = Product::find($product_id);
            if (!empty($product_image->product_image)) {
            unlink('public/uploads/images/product/'.$product_image->product_image);
            }
            
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.time().'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/images/product',$new_image);
            $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công.');
                    return Redirect::to('manage-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công.');
        return Redirect::to('manage-product');
    }
    
    public function delete_product($product_id){
        $this->AuthLogin();
        $product = Product::find($product_id);
        
            if (!empty($product->product_file)) {
               unlink('public/uploads/files/'.$product->product_file);
            }
            if (!empty($product->product_image)) {
                unlink('public/uploads/images/product/'.$product->product_image);
            }
        
        
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công.');
        return Redirect::to('manage-product');
    }

    public function details_product(Request $request, $product_slug){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        $product_details = DB::table('tbl_product')->where('product_status','1')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->where('tbl_product.product_slug',$product_slug)->select('tbl_product.*','tbl_product_khuyenmai.*','tbl_category_product.*','tbl_brand_product.*')
        ->get();
        foreach ($product_details as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
             //seo 
                $meta_desc = $value->product_name;
                $meta_keywords = $value->product_slug;
                $meta_title = $value->product_name;
                $image_og = url('public/uploads/images/product/'.$value->product_image);
                $url_canonical = $request->url();
            //--seo
        }
        $product_gal = DB::table('tbl_product')->where('product_status','1')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->where('tbl_product.product_slug',$product_slug)
        ->get();
        foreach ($product_gal as $key => $val) {
            $product_id_gal = $val->product_id;
        }
        $gallery=Gallery::where('product_id',$product_id_gal)->get();
        
        $related_product = DB::table('tbl_product')->where('product_status','1')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_slug',[$product_slug])
        ->get();

        return view('pages.show_detail_product')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('product_details',$product_details)->with('related',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og)->with('gallery',$gallery);
    }

    public function export_csv(){
        return Excel::download(new ExcelExports , 'product.xlsx');
    }

    public function import_csv(Request $request){
        $path = $request->file('fileexcel')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }


}
