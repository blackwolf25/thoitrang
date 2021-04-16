<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use Session;
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
use App\Customer;
use App\Coupon;
use App\Product;
use App\QuaTang;
use PDF;

class OrderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function manage_order(){ 
    	$this->AuthLogin();
        $all_order = Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('all_order'));
    }
    
    public function delete_order($order_code){
        $this->AuthLogin();

        $order = Order::where('order_code',$order_code)->first();
        $order->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return redirect()->back();
    }

    public function view_order($order_code){
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
            $quatang = $ord->quatang;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();

        foreach($order_details_product as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            Session::put('product_coupon',$product_coupon);
        }
        $product_coupon=Session::get('product_coupon');
        $coupon = Coupon::where('coupon_code',$product_coupon)->first();

        if($product_coupon != ''){
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            $product_coupon = $coupon->product_coupon;

        }else{
            $coupon_condition = '';
            $coupon_number = '';
        }
        $all_quatang = QuaTang::get();
        $dsquatang = Order::leftjoin('tbl_quatang','tbl_order.quatang_id','tbl_quatang.quatang_id')->where('order_code',Session::get('order_code'))->get();
        return view('admin.view_order')->with(compact('order_details','order','customer','shipping','order_details_product','coupon_condition','coupon_number','product_coupon','order_status','all_quatang','quatang','dsquatang'));
    }
    
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();

        $order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

        $output = '';

        $output.='<style>
        body{
            font-family: DejaVu Sans;
            font-align: center;
            font-size: 12px;
        }
        table, th, td {  
            border: 1px solid black;  
            border-collapse: collapse;  
        }  
        th, td {  
            padding: 10px;  
        }  
        table#alter tr:nth-child(even) {  
            background-color: #736F6E;  
        }  
        table#alter tr:nth-child(odd) {  
            background-color: #736F6E;  
        }  
        table#alter th {  
            color: white;  
            background-color: #736F6E;  
}  
        </style>
        <h1><center>thoitrang</center></h1>
        <h4><center>-----</center></h4>
        
        <h4><center>HÓA ĐƠN BÁN HÀNG</center></h4>
        <p>Thông tin người mua hàng:</p>
        <table style="width:100%; text-align:center" class="table">
                <thead>
                    <tr>
                        <th>Họ và tên</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
                
        $output.='      
                    <tr>
                        <td>'.$customer->customer_name.'</td>
                        <td>'.$customer->customer_phone.'</td>
                        <td>'.$customer->customer_email.'</td> 
                    </tr>';
                

        $output.='              
                </tbody>
            
        </table>

        <p>Giao hàng đến địa chỉ:</p>
            <table style="width:100%; text-align:center" class="table">
                <thead>
                    <tr>
                        <th>Họ và tên người nhận</th>
                        <th>Địa chỉ nhận hàng</th>
                        <th>Số điện thoại liên hệ giao hàng</th>
                        <th>Email liên hệ giao hàng</th>
                        <th>Ghi chú đơn hàng ( ghi rõ size, màu )</th>
                    </tr>
                </thead>
                <tbody>';
                
        $output.='      
                    <tr>
                        <td>'.$shipping->shipping_name.'</td>
                        <td>'.$shipping->shipping_address.'</td>
                        <td>'.$shipping->shipping_phone.'</td>
                        <td>'.$shipping->shipping_email.'</td>
                        <td>'.$shipping->shipping_notes.'</td>
                        
                    </tr>';
                

        $output.='              
                </tbody>
            
        </table>

        <p>Đơn hàng đã đặt gồm có:</p>
            <table style="width:100%; text-align:center" class="table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Phí vận chuyển</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';
                $i=0;
                $total = 0;

                foreach($order_details_product as $key => $product){
                    $i++;
                    $subtotal = $product->product_price*$product->product_sales_quantity;
                    $total+=$subtotal;
                    $feeship = $product->product_feeship;

                    if($product->product_coupon!=''){
                        $product_coupon = $product->product_coupon;
                    }else{
                        $product_coupon = '';
                    }       

        $output.='      
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$product->product_name.'</td>
                        <td>'.number_format($feeship,0,',','.').' VNĐ'.'</td>
                        <td>'.$product->product_sales_quantity.'</td>
                        <td>'.number_format($product->product_price,0,',','.').' VNĐ'.'</td>
                        <td>'.number_format($subtotal,0,',','.').' VNĐ'.'</td>
                        
                    </tr>';
                }
                foreach($order_details_product as $key => $order_d){
                    $product_coupon = $order_d->product_coupon;
                }

                if($product_coupon != ''){
                    $coupon = Coupon::where('coupon_code',$product_coupon)->first();
                    $coupon_condition = $coupon->coupon_condition;
                    $coupon_number = $coupon->coupon_number;

                    if($coupon_condition == 1){
                        $coupon_echo = 'Giảm '.$coupon_number.' % trên tổng hóa đơn.';
                        $total_coupon = ($total*$coupon_number)/100;
                    }elseif($coupon_condition == 2){
                        $coupon_echo = 'Giảm '.number_format($coupon_number,0,',','.').' VNĐ trên tổng hóa đơn.';
                        $total_coupon = $coupon_number;
                    }else{
                    $coupon_condition = 0;
                    $coupon_number = 0;
                    $coupon_echo = 'Miễn phí vận chuyển';
                    $total_coupon = 0;
                    $feeship = 0;
                    }
                }else{
                $product_coupon = '';   
                $coupon_echo = '';
                $total_coupon = 0;
                }

        $output.= '<tr>
                <td colspan="6" style="text-align:center">
                    <p>Tổng tiền hàng hóa: '.number_format($total,0,',','.').' VNĐ'.'</p>
                    <p>Mã khuyến mãi: '.$product_coupon.'</p>
                    <p>Nội dung khuyến mãi: '.$coupon_echo.'</p>
                    <p>Phí vận chuyển: '.number_format($feeship,0,',','.').' VNĐ'.'</p>
                    <p>Thanh toán: <strong>'.number_format($total - $total_coupon + $feeship,0,',','.').' VNĐ </strong>'.'</p>
                </td>
        </tr>';
        $output.='              
                </tbody>
            
        </table>

        <p>Xác nhận</p>
            <table style="width:100%; text-align:center">
                <thead>
                    <tr>
                        <th>Người lập phiếu</th>
                        <th>Người nhận</th>
                    </tr>
                </thead>
                <tbody>';
                        
        $output.='              
                </tbody>    
        </table>
        ';
        return $output;

    }

public function update_order_qty(Request $request){
       

        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status==4){
            foreach($data['order_product_id'] as $key => $product_id){
                
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                                $pro_remain = $product_quantity - $qty;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold + $qty;
                                $product->save();
                        }
                }
            }
        }elseif($order->order_status == 5){
            foreach($data['order_product_id'] as $key => $product_id){
                
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                                $pro_remain = $product_quantity + $qty;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold - $qty;
                                $product->save();
                        }
                }
            }
        }elseif($order->order_status!=4 && $order->order_status!=5){
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                        if($key==$key2){
                                $pro_remain = $product_quantity;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold;
                                $product->save();
                        }
                }
            }
        }

    }

    public function update_qty(Request $request){
        $data = $request->all();
        $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function qua_tang(Request $request){
        $quatang_id = $request->quatang_id;
        $quatang_sl = $request->quatang_sl;

        $quatang_gia = QuaTang::where('quatang_id',$quatang_id)->first()->quatang_gia;
        $quatang_soluong = QuaTang::where('quatang_id',$quatang_id)->first()->quatang_soluong;

        $quatang= $quatang_sl * $quatang_gia;
        $soluongcon= $quatang_soluong-$quatang_sl;
        Order::where('order_code',Session::get('order_code'))->update(['quatang_id'=>$quatang_id]);
        Order::where('order_code',Session::get('order_code'))->update(['quatang'=>$quatang]);
        QuaTang::where('quatang_id',$quatang_id)->update(['quatang_soluong'=>$soluongcon]);
        
        Session::forget('order_code');
        Session::put('message','Bạn đã cập nhật thêm quà tặng kèm cho đơn hàng này!');
        return redirect()->back();
    }
    
    public function qua_tang_tri_an(){
        $this->AuthLogin();
        $allquatang=QuaTang::get();
        return view('admin.gift')->with(compact('allquatang'));
    }
    public function delete_quatang(Request $request, $quatang_id){
        $this->AuthLogin();
        $quatang = QuaTang::find($quatang_id);
        $quatang->delete();
        Session::put('message','Xóa quà tặng thành công.');
        return redirect()->back();
    }
    
    public function update_quatang(Request $request,$quatang_id){
        $this->AuthLogin();
        $data = array();
        $data['quatang_ten'] = $request->quatang_ten;
        $data['quatang_soluong'] = $request->quatang_soluong;
        $data['quatang_gia'] = $request->quatang_gia;
   
        DB::table('tbl_quatang')->where('quatang_id',$quatang_id)->update($data);
        Session::put('message','Cập nhật quà tặng thành công.');
        return redirect()->back();
    }
    
    public function add_quatang(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['quatang_ten'] = $request->quatang_ten;
        $data['quatang_soluong'] = $request->quatang_soluong;
        $data['quatang_gia'] = $request->quatang_gia;
   
        DB::table('tbl_quatang')->insert($data);
        Session::put('message','Cập nhật quà tặng thành công.');
        return redirect()->back();
    }
    public function update_totalship(Request $request, $order_id){
        $this->AuthLogin();
        $order_total = $request->order_total;
        $order_ship = $request->order_ship;
        Order::where('order_id', $order_id)->update(['order_total'=>$order_total]);
        Order::where('order_id', $order_id)->update(['order_ship'=>$order_ship]);
        Session::put('message','Cập nhật thông tin đơn hàng thành công.');
        return redirect()->back();
    }

}
