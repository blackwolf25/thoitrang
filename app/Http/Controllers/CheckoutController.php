<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Slider;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use Mail;

class CheckoutController extends Controller
{
	

	public function loginregister_checkout(Request $request){
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

		return view('pages.loginregister_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
    }

    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		Session::put('customer_name',$result->customer_name);
    		return Redirect::to('/gio-hang')->with('message','Quý khách đã đăng nhập tài khoản thành công!');
    	}else{
    		return Redirect::to('/dangnhap-dangky-thanhtoan')->with('message','Đăng nhập thất bại vì có sự nhầm lẫn trong tài khoản hoặc mật khẩu của Quý khách đã nhập. Quý khách vui lòng đăng nhập lại.');
    	}
        Session::save();
    }

    public function add_customer(Request $request){
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_add'] = $request->customer_add;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/gio-hang')->with('message','Quý khách đã đăng ký tài khoản thành công!');
    }

    public function checkout(Request $request){
        
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

        $city = City::orderby('matp','ASC')->get();

    	return view('pages.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('slider',$slider)->with('image_og',$image_og);
    }

    public function logout(){
    	Session::flush();
    	return Redirect::to('/trang-chu')->with('message','Quý khách đã đăng xuất tài khoản thành công!');
    }

    public function select_delivery_home(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>----- Chọn Quận / Huyện / Thị xã -----</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>----- Chọn Phường/ Xã / Thị trấn -----</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
            echo $output;
        }
    }

    public function calculate_fee(Request $request){
            $data = $request->all();
            if($data['matp']){
                $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
                if($feeship){
                    $count_feeship = $feeship->count();
                    if($count_feeship>0){
                         foreach($feeship as $key => $fee){
                            Session::put('fee',$fee->fee_feeship);
                            Session::save();
                        }
                    }else{ 
                        Session::put('fee',10000);
                        Session::save();
                    }
                }
               
            }
    }

    public function confirm_order(Request $request){
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

        
         $data = $request->all();
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

         $order = new Order;
         $order->customer_id = Session::get('customer_id');;
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;
         $order->order_total= Session::get('order_total');
         $order->order_nhap= Session::get('order_nhap');
         $order->order_ship= Session::get('fee');
         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->created_at = now();
         $order->save();

         if(!empty(Session::get('cart'))){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon =  $data['order_coupon'];
                $order_details->product_feeship = $data['order_fee'];
                $order_details->save();
            }
         }
        
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
        
        return Redirect::to('/cam-on')->with('message','Quý khách đã đặt hàng thành công!');
        
    }



}
