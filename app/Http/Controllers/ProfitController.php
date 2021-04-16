<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Profit;
use App\Order;
session_start();

class ProfitController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function profit(){
    	$this->AuthLogin();
    	$all_order = Order::count();
    	$doanhthu = Order::where('order_status',4)->get()->sum('order_total');
    	$von = Order::where('order_status',4)->get()->sum('order_nhap');
    	$vanchuyen = Order::where('order_status',4)->get()->sum('order_ship');
    	$quatang = Order::where('order_status',4)->get()->sum('quatang');
    	$chiphi = Profit::sum('profit_money');
    	$all_profit = Profit::get();

    	return view('admin.profit')->with(compact('all_profit','all_order','doanhthu','von','vanchuyen','chiphi','quatang'));
    }

    public function delete_profit($profit_id){
        $this->AuthLogin();
        DB::table('tbl_profit')->where('profit_id',$profit_id)->delete();
        Session::put('message','Xóa chi phí lợi nhuận thành công.');
        return Redirect::to('/profit');
    }

    public function insert_profit(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['profit_date'] = $request->profit_date;
        $data['profit_content'] = $request->profit_content;
        $data['profit_money'] = $request->profit_money;

        DB::table('tbl_profit')->insert($data);
        Session::put('message','Thêm chi phí lợi nhuận thành công.');
        return Redirect::to('/profit');
    }

    public function update_profit(Request $request,$profit_id){
        $this->AuthLogin();
        $data = array();
        $data['profit_date'] = $request->profit_date;
        $data['profit_content'] = $request->profit_content;
        $data['profit_money'] = $request->profit_money;

        DB::table('tbl_profit')->where('profit_id',$profit_id)->update($data);
        Session::put('message','Cập nhật thông tin chi phí lợi nhuận thành công.');
        return Redirect::to('/profit');
    }

}
