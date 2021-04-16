<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Cart;
use App\Product;
use App\Brand;
use App\CategoryProduct;
use Mail;

class HomeController extends Controller
{
    public function index(Request $request){
        //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO


    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $cate_product_0 = DB::table('tbl_category_product')->where('category_parent','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();

        $banner370x230 = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','0')->orderby('banner_id','desc')->get();
        $bannertop = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','1')->orderby('banner_id','desc')->get();
        $bannerdown = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','2')->orderby('banner_id','desc')->get();
        $bannerkm = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','3')->orderby('banner_id','desc')->get();
        $bannernew = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','4')->orderby('banner_id','desc')->get();
        $bannerbc = DB::table('tbl_banner')->where('banner_status','1')->where('banner_pos','5')->orderby('banner_id','desc')->get();

        $product = DB::table('tbl_product')->where('product_status','1')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->orderby('tbl_product.product_id','desc')->paginate(30);

        $product_kmnb = Product::where('product_status','1')
        ->join('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')->where('khuyenmai_noibat','1')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->orderby('tbl_product.product_id','desc')->limit(20)->get();

        $product_km = Product::where('product_status','1')
        ->join('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')->where('khuyenmai_status','1')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->orderby('tbl_product.product_id','desc')->limit(20)->get();

        $product_new = Product::where('product_status','1')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->orderby('tbl_product.product_id','desc')->limit(20)->get();

        $product_bc = DB::table('tbl_product')->where('product_status','1')
        ->leftjoin('tbl_product_khuyenmai','tbl_product.product_id','=','tbl_product_khuyenmai.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')->where('category_status','1')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')->where('brand_status','1')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->orderby('tbl_product.product_sold','desc')->limit(20)->get();
        

		return view('pages.home')->with('category',$cate_product)->with('category0',$cate_product_0)->with('brand',$brand_product)->with('banner370x230',$banner370x230)->with('bannertop',$bannertop)->with('bannerdown',$bannerdown)->with('bannerkm',$bannerkm)->with('bannernew',$bannernew)->with('bannerbc',$bannerbc)->with('slider',$slider)->with('product',$product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og)->with('product_new',$product_new)->with('product_km',$product_km)->with('product_kmnb',$product_kmnb)->with('product_bc',$product_bc);
	}
    
    public function search(Request $request){
        //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO
        
        $keywords = $request->search_product;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')
        ->leftjoin('tbl_product_khuyenmai','tbl_product_khuyenmai.product_id','=','tbl_product.product_id')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->select("tbl_product_khuyenmai.*", "tbl_product.*", "tbl_category_product.*", "tbl_brand_product.*")
        ->get(); 

        if($search_product){
            return view('pages.searchproduct')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('keywords',$keywords)->with('image_og',$image_og);
        } else{
        return view('pages.searchproduct')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('message', 'Không tìm thấy sản phẩm nào. Quý khách vui lòng tìm thêm sản phẩm khác.')->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('keywords',$keywords)->with('image_og',$image_og);
        }
    }            
    
    public function email(Request $request){
        $data = array();
        $data['contact_email'] =  $request->email;
        $data['contact_status'] = "0";
        DB::table('tbl_contact')->insert($data);
        Session::put('message','Quý khách đã đăng ký nhận thông báo bằng email'.$request->email.' thành công. Trùm Poppers kính chúc Quý khách có ngày mua sắm vui vẻ.');
        return Redirect::to('/trang-chu');
    }

    public function cong_tac_vien(Request $request){
        //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get(); 
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        return view('pages.congtacvien')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
    }

    public function login_register(Request $request){
        //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();

        return view('pages.login_and_register')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
    }

    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            return redirect('/trang-chu')->with('message', 'Quý khách đã đăng nhập thành công!');
        }else{
            return redirect()->back()->with('message', 'Đăng nhập thất bại vì có sự nhầm lẫn trong tài khoản hoặc mật khẩu của Quý khách đã nhập. Quý khách vui lòng đăng nhập lại.');
        }
        Session::save();
    }
    public function logout(){
        Session::put('customer_id',null);
        Session::put('customer_name',null);
        
        return Redirect::to('/trang-chu');
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_add'] = $request->customer_address;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return redirect('/trang-chu')->with('message', 'Quý khách đã đăng ký tài khoản thành công!');
    }

    public function error_page(){
        return view('errors.404');
    }
    public function send_mail(){
                $to_name = "trumpoppers.com";
                $to_email = "phdinhquy@gmail.com";//send to this email
        
                $data = array("name"=>"websiteHuỳnh Đức","body"=>"Có đơn hàng mới đặt trên hệ thống. Bạn vui lòng vào hệ thống và kiểm tra đơn hàng nhé."); //body of mail.blade.php
            
                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Có đơn hàng mới từ websiteHuỳnh Đức');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });

    }
    public function camon(Request $request){
         //SEO
        $meta_desc = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp"; 
        $meta_keywords = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $meta_title = "thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp";
        $url_canonical = $request->url();

        $image_og = url('public/uploads/images/website/uiuy.png');
        //./SEO

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $slider = DB::table('tbl_slider')->where('slider_status','1')->orderby('slider_id','desc')->get();
        // $this->send_mail();
        return view('pages.cam_on')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider)->with('image_og',$image_og);
    }

    

}
