<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
session_start();

class CouponController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

	public function manage_coupon(){
		$this->AuthLogin();
        $all_product = DB::table('tbl_product')->get();
        $product_khuyenmai= DB::table('tbl_product_khuyenmai')
        ->join('tbl_product','tbl_product.product_id','=','tbl_product_khuyenmai.product_id')
        ->orderby('tbl_product_khuyenmai.product_id','desc')->paginate();
	    $coupon = Coupon::orderby('coupon_id','DESC')->paginate();
    	return view('admin.manage_coupon')->with(compact('coupon'))->with(compact('product_khuyenmai'))->with(compact('all_product'));
    }
    
    public function insert_coupon(Request $request){
    	$this->AuthLogin();
    	$data = $request->all();
    	$coupon = new Coupon;
    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_condition = $data['coupon_condition'];
    	$coupon->coupon_status = $data['coupon_status'];
    	$coupon->save();

    	Session::put('message','Thêm mã khuyến mãi thành công');
        return Redirect::to('/coupon');
    }

    public function unactive_coupon($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>0]);
        Session::put('message','Tắt kích hoạt coupon thành công.');
        return Redirect::to('coupon');

    }
    public function active_coupon($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update(['coupon_status'=>1]);
        Session::put('message','Bật kích hoạt coupon thành công.');
        return Redirect::to('coupon');

    }
    public function update_coupon(Request $request,$coupon_id){
        $this->AuthLogin();
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_status'] = $request->coupon_status;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_number'] = $request->coupon_number;
        $data['coupon_condition'] = $request->coupon_condition;
        DB::table('tbl_coupon')->where('coupon_id',$coupon_id)->update($data);
        Session::put('message','Cập nhật coupon thành công.');
        return Redirect::to('/coupon');
    }

    public function delete_coupon(Request $request, $coupon_id){
        $coupon =   DB::table('tbl_coupon')-> where('coupon_id',$coupon_id);
        
        $coupon->delete();
        Session::put('message','Xóa coupon thành công.');
        return redirect()->back();
    }



    public function insert_khuyenmai(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['khuyenmai_status'] = $request->khuyenmai_status;
        $data['khuyenmai_gia'] = $request->khuyenmai_gia;
        $data['khuyenmai_noibat'] = $request->khuyenmai_noibat;

        DB::table('tbl_product_khuyenmai')->insert($data);

        Session::put('message','Thêm sản phẩm khuyến mãi thành công');
        return Redirect::to('/coupon');
    }

    public function unactive_khuyenmai($khuyenmai_id){
        $this->AuthLogin();
        DB::table('tbl_product_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->update(['khuyenmai_status'=>0]);
        Session::put('message','Tắt kích hoạt sản phẩm khuyến mãi thành công.');
        return Redirect::to('/coupon');

    }
    public function active_khuyenmai($khuyenmai_id){
        $this->AuthLogin();
        DB::table('tbl_product_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->update(['khuyenmai_status'=>1]);
        Session::put('message','Bật kích hoạt sản phẩm khuyến mãi thành công.');
        return Redirect::to('/coupon');

    }
    public function update_khuyenmai(Request $request,$khuyenmai_id){
        $this->AuthLogin();
        $data = array();
        $data['product_id'] = $request->product_id;
        $data['khuyenmai_status'] = $request->khuyenmai_status;
        $data['khuyenmai_gia'] = $request->khuyenmai_gia;
        $data['khuyenmai_noibat'] = $request->khuyenmai_noibat;

        DB::table('tbl_product_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->update($data);
        Session::put('message','Cập nhật sản phẩm khuyến mãi thành công.');
        return Redirect::to('/coupon');
    }

    public function delete_khuyenmai(Request $request, $khuyenmai_id){
        $khuyenmai =   DB::table('tbl_product_khuyenmai')-> where('khuyenmai_id',$khuyenmai_id);
        
        $khuyenmai->delete();
        Session::put('message','Xóa sản phẩm khuyến mãi thành công.');
        return redirect()->back();
    }

    public function unactive_khuyenmainb($khuyenmai_id){
        $this->AuthLogin();
        DB::table('tbl_product_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->update(['khuyenmai_noibat'=>0]);
        Session::put('message','Tắt kích hoạt sản phẩm khuyến mãi nổi bật thành công.');
        return Redirect::to('/coupon');

    }
    public function active_khuyenmainb($khuyenmai_id){
        $this->AuthLogin();
        DB::table('tbl_product_khuyenmai')->where('khuyenmai_id',$khuyenmai_id)->update(['khuyenmai_noibat'=>1]);
        Session::put('message','Bật kích hoạt sản phẩm khuyến mãi nổi bật thành công.');
        return Redirect::to('/coupon');

    }

    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon==true){
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }

}
