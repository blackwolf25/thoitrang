<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Carbon\Carbon;
use App\Coupon;
use App\Customer;

class MailController extends Controller
{
    public function send_mail(){
        $to_name = "Trùm Strore";
                $to_email = "phdinhquy@gmail.com";
        
                $data = array("name"=>"Mail từ Trùm Store","body"=>'Trùm Store Body'); 
            
                Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Trùm Store Sub');
                    $message->from($to_email,$to_name);
                });
        return Redirect::to('/trang-chu')->with('message','');
    }

    public function send_coupon(){
    	$all_cus = Customer::get();
    	$now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
    	$title_mail = "Mã khuyến mãi ngày".' '.$now;
    	$data[];
    	foreach ($all_cus as $key => $cus) {
    		$data['email'][] = $cus->customer_email;
    	}
    	MAil::send('admin.mail.send_coupon', $data, function($message) use ($title_mail,$data){
    		$message->to($data['email'])->subject($title_mail);
    		$message->form($data['email'],$title_mail);
    	})
    	return Redirect::to('/coupon')->with('message','Gửi mã khuyến mãi cho khách hàng thành công.');
    }


}
