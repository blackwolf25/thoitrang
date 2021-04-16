<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use Cart;

class ContactController extends Controller
{	
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function contact (Request $request){
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

		return view('pages.contact')->with('category',$cate_product)->with('brand',$brand_product)->with('slider',$slider)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('image_og',$image_og);
    }

    public function add_contact(Request $request){
    	$data = array();
        $data['contact_email'] =  $request->email;
        $data['contact_name'] =  $request->name;
        $data['contact_phone'] =  $request->phone;
        $data['contact_content'] =  $request->content;
        $data['contact_status'] ="0";
        DB::table('tbl_contact')->insert($data);
        Session::put('message','Trùm Poppers xin cảm ơn bạn vì đã có những góp ý hay phản hồi để chúng tôi hoàn thiện hơn.');
        return Redirect()->back();;
    }

    public function manage_contact(){
    	$this->AuthLogin();
    	$all_contact= DB::table('tbl_contact')->orderBy('contact_id','DESC')->paginate();
    	return view('admin.manage_contact')->with(compact('all_contact'));
    }

    public function unactive_contact($contact_id){
        $this->AuthLogin();
        DB::table('tbl_contact')->where('contact_id',$contact_id)->update(['contact_status'=>0]);
        Session::put('message','Tắt kích hoạt liên hệ thành công.');
        return Redirect::to('manage-contact');

    }
    public function active_contact($contact_id){
        $this->AuthLogin();
        DB::table('tbl_contact')->where('contact_id',$contact_id)->update(['contact_status'=>1]);
        Session::put('message','Bật kích hoạt liên hệ thành công.');
        return Redirect::to('manage-contact');

    }

    public function delete_contact(Request $request, $contact_id){
        $contact = 	DB::table('tbl_contact')-> where('contact_id',$contact_id);
        $contact->delete();
        Session::put('message','Xóa liên hệ thành công.');
        return redirect()->back();
    }

    public function update_contact(Request $request,$contact_id){
        $this->AuthLogin();
        $data = array();
        $data['contact_rep'] = $request->contact_rep;
        $data['contact_status'] = $request->contact_status;
            
        DB::table('tbl_contact')->where('contact_id',$contact_id)->update($data);
        Session::put('message','Cập nhật góp ý liên lạc thành công.');
        return Redirect::to('manage-contact');
    }


}
