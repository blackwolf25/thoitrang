<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\Admin;
use App\Order;
use App\Customer;
use App\Roles;
use App\Rules\Captcha; 
use Validator;
use App\Contact;
use App\Product;

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function index(){
    	return view('admin_login');
    }

    public function show_dashboard(){
    	$this->AuthLogin();
        $admin_count = Admin::where('admin_type',2)->count();
        $customer_count = Customer::count();
        $order_count = Order::count();
        $product_count = Product::count();
        $order_dashboard = Order::where('order_status',1)->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')->get();
        $product_dashboard = Product::get();
        $contact_dashboard = Contact::where('contact_status',0)->get();
    	return view('admin.home',compact('admin_count','customer_count','order_count','product_count','order_dashboard','product_dashboard','contact_dashboard'));
    }

    public function dashboard(Request $request){
       	$data = $request->validate([
            'admin_email' => 'required',
            'admin_password' => 'required',
            // 'g-recaptcha-response' => new Captcha(),    
        ]);

        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);

        $login = DB::table('tbl_admin')->join('tbl_roles','tbl_roles.id_roles','=','tbl_admin.admin_type')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->where('admin_status','1')->first();

        $active = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->where('admin_status','0')->first();

        if($login){
                Session::put('admin_name',$login->admin_name);
                Session::put('admin_id',$login->admin_id);
                Session::put('admin_type',$login->admin_type);
                Session::put('admin_avatar',$login->admin_avatar);
                Session::put('admin_position',$login->admin_role_name);
                Session::put('admin_created',$login->created_at);

                return Redirect::to('/dashboard');
            }
        elseif ($active) {
                Session::put('message','T??i kho???n c???a b???n ch??a ???????c k??ch ho???t. <br>B???n vui l??ng ?????i t??i kho???n ???????c k??ch ho???t r???i ????ng nh???p l???i sau nh??.');
                return Redirect::to('/admin');
        }{
                Session::put('message','M???t kh???u ho???c t??i kho???n b??? sai. Vui l??ng nh???p l???i.');
                return Redirect::to('/admin');
        }
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        Session::put('admin_avatar',null);
        Session::put('admin_position',null);
        Session::put('admin_created',null);
        Session::put('admin_type',null);
        
        return Redirect::to('/admin');
    }


    public function admin_register(Request $request){
    	return view('admin_register');
    }
    public function add_admin(Request $request){
        $checkemail = Admin::where('admin_email',$request->admin_email)->first();
        if ($checkemail) {
            Session::put('message','Email n??y ???? ???????c d??ng ????? ????ng k?? r???i.<br>B???n vui l??ng ?????i email kh??c ho???c l???y l???i m???t kh???u t??i kho???n n??y.');
            return Redirect::to('/admin');
        }
        $data = array();
        $data['admin_status'] = "0";
        $data['admin_type'] = "2";
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_name'] = $request->admin_name;
        $data['admin_dateofbirth'] = $request->admin_dateofbirth;
        $data['admin_phone'] = $request->admin_phone;
        $data['admin_add'] = $request->admin_add;
        
            DB::table('tbl_admin')->insert($data);
            Session::put('message','Th??m t??i kho???n th??nh c??ng.<br>B???n vui l??ng ?????i h??? th???ng k??ch ho???t t??i kho???n r???i quay l???i ????ng nh???p sau.');
            return Redirect::to('/admin');
    }

    public function validation($request){
        return $this->validate($request,[
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255',  
            'admin_dateofbirth' => 'required|max:255',  
            'admin_phone' => 'required|max:255',  
            'admin_add' => 'required|max:255',
        ]);
    }

    public function user_infor(){
        $this->AuthLogin();
    	$user = DB::table('tbl_admin')->where('admin_id',Session::get('admin_id'))->orderby('tbl_admin.admin_id','desc')->get();
    	
        return view('admin.user_infor')->with(compact('user'));
    }

     public function admin_forgot_password(){
        return view('admin_forgot_password');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' =>$val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function resetmk(Request $request){
        $user_acount=$request->user_email;
        $checkuser=Admin::where('admin_email', $user_acount)->get();
        if (!empty($checkuser)) {
            Admin::where('admin_email', $user_acount)->update(['acount_status'=>1]);
            Session::put('message','Y??u c???u kh??i ph???c m???t kh???u t??i kho???n c???a b???n ???? ???????c g???i ?????n h??? th???ng th??nh c??ng.<br>B???n vui l??ng ?????i h??? th???ng k??ch ho???t t??i kho???n r???i quay l???i ????ng nh???p sau.');
            return Redirect::to('/admin');
        }else{
            Session::put('message','T??i kho???n c???a b???n kh??ng t???n t???i trong h??? th???ng! ????? ????ng nh???p v??o h??? th???ng b???n h??y ????ng k?? t??i kho???n m???i nh??!');
            return Redirect::to('/admin');
        }
    }

    public function resetmk_admin(Request $request, $admin_id){
        $reset = Admin::where('admin_id', $admin_id)->get();
        foreach($reset as $key =>$rs){
            $newmk=md5($rs->admin_phone);
            Admin::where('admin_id', $admin_id)->update(['admin_password'=>$newmk]);
            Admin::where('admin_id', $admin_id)->update(['acount_status'=>0]);
            
            Session::put('message','B???n ???? kh??i ph???c m???t kh???u t??i kho???n v??? m???t kh???u m???c ?????nh l?? s??? ??i???n tho???i khi ????ng k?? t??i kho???n.');
            return Redirect::to('/dashboard');
        }
    }

}
