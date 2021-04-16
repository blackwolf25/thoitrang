<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
session_start();

use App\City;
use App\Province;
use App\Wards;
use App\Feeship;

class DeliveryController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

	public function delivery(Request $request){
        $this->AuthLogin();
        $city = City::orderby('matp','ASC')->get();

        return view('admin.manage_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
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

    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new Feeship();
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
        echo($fee_ship);
       
    }

    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_feeship = $fee_value;
        
    }
    
    public function select_feeship(){
        $feeship = Feeship::orderby('fee_id','DESC')->get();
        $output = '';
        $output .= '
        <form>
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách cước phí vận chuyển</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th>Tỉnh/Thành phố</th>
                                    <th>Huyện/Thị xã/Quận</th>
                                    <th>Xã/Thị trấn/Phường</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Xóa</th>
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                ';
                foreach($feeship as $key => $fee){
                $output.='
                    <tr style="text-align: center; align-self: center;">
                        <td style="text-align: left;">'.$fee->city->name_city.'</td>
                        <td style="text-align: left;">'.$fee->province->name_quanhuyen.'</td>
                        <td style="text-align: left;">'.$fee->wards->name_xaphuong.'</td>
                        <td style="text-align: center;" contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.$fee->fee_feeship.' VNĐ</td>
                        <td><button type="button" data-feeship_id="'.$fee->fee_id.'" class="btn btn-danger delete-fee-ship"><i class="fa fa-trash"></i></button></td>
                    </tr>
                    ';
                }
                $output.='      
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </form>
                ';
                echo $output;
    }   

    public function delete_feeship(Request $request){
        $feeship_id = $request->feeship_id;
        $feeship = Feeship::find($feeship_id);
        $feeship->delete();
    }                          

}
