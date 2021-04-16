@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý đơn đặt hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('/manage-order')}}">Danh sách đơn hàng</a></li>
              <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<div class="container-fluid">
  <div class="row">
        <div class="col-12">
          <a type="button" name="" class="btn btn-danger" href="{{URL::to('manage-order')}}">Quay về danh sách đơn hàng</a>
        </div>
  </div>
  <br>
	<div class="row">
        <div class="col-12">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Thông tin người gửi hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 100px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Tên khách hàng</th>
                      <th>Địa chỉ</th>
                      <th>Số điện thoại</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$customer->customer_name}}</td>
                      <td>{{$customer->customer_add}}</td>
                      <td>{{$customer->customer_phone}}</td>
                      <td>{{$customer->customer_email}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
        <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Thông tin người nhận hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 100px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Họ và tên</th>
                      <th>Địa chỉ</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Note</th>
                      <th>Hình thức thanh toán</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>{{$shipping->shipping_name}}</td>
                      <td>{{$shipping->shipping_address}}</td>
                      <td>{{$shipping->shipping_phone}}</td>
                      <td>{{$shipping->shipping_email}}</td>
                      <td>
                        <?php
                          if($shipping->shipping_notes){
                        ?>
                        {{$shipping->shipping_notes}}
                        <?php
                          }else{
                        echo "Không có";
                        }
                        ?>
                      </td>
                      <td>
                        <?php
                          if($shipping->shipping_method==0){
                        ?>
                          <a style="color: red" href=""><strong>Chuyển khoản thông qua ngân hàng</strong></a>
                        <?php
                          }else if ($shipping->shipping_method==1){
                        ?>
                          <a style="color: green" href=""><strong>Thanh toán bằng ví điện tử</strong></a>
                        <?php
                          }else if ($shipping->shipping_method==2){
                        ?>
                          <a style="color: blue" href=""><strong>Thanh toán bằng tiền mặt</strong></a></td>
                        <?php
                          }
                        ?>           
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
        <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Thông tin chi tiết hàng hóa của đơn hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 500px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th>STT</th>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Tổng tiền</th>
                  </thead>
                  <tbody>
                    @php
                      $i = 0;
                      $total = 0;
                    @endphp
                    @foreach ($order_details as $key =>$details)
                    @php
                      $i++;
                      $subtotal = $details->product_price * $details->product_sales_quantity;
                      $total += $subtotal;
                      $product_feeship = $details->product_feeship;
                      $total_coupon = 0;
                      Session::put('order_code', $details->order_code);
                    @endphp
                    <tr style="text-align: center;" class="color_qty_{{$details->product_id}}">
                      <td>{{ $i }}</td>
                      <td style="text-align: left;">{{$details->product_name}}</td>
                      <td style="text-align: right;">{{number_format($details->product_price).' VNĐ'}}</td>
                      
                      <td>
                        <div class="input-group">
                          <input style="text-align: center" type="number" min="1" {{$order_status!=1 ? 'disabled' : ''}} class="form-control rounded-0 order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">

                          <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                          <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                          <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

                          @if ($order_status==1)
                          <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order"><i class="fa fa-sync"></i></button>
                          </span>
                          @endif
                        </div>
                      </td>

                      <td style="text-align: right;">{{number_format($subtotal).' VNĐ'}}</td>
                    </tr>

                    @endforeach
                    
                    <tr>
                      <td colspan="3"></td>
                      <td> Tổng tiền sản phẩm:</td>
                      <td style="text-align: right;color: red"> <strong>{{number_format($total).' VNĐ'}}</strong></td>
                    </tr>
                    @if($details->product_coupon!='')
                    <tr>
                      <td colspan="3"></td>
                      <td> Mã khuyến mãi:</td>
                      <td style="text-align: right;color: red"> <strong>{{$details->product_coupon}}</strong></td>
                    </tr>
                    <tr>
                      @if ($coupon_condition == 0)
                          @php
                            $total_coupon = 0;
                            $product_feeship = 0;
                          @endphp
                          <td colspan="3"></td>
                          <td> Nội dung giảm</td>
                          <td style="text-align: right;color: red"> <strong>Miễn phí phí vận chuyển</strong></td>
                      @elseif($coupon_condition == 1)
                          @php
                            $total_coupon = (($total*$coupon_number)/100);
                            echo '<td colspan="3"></td>';
                            echo '<td> Nội dung giảm:</td>';
                            echo '<td style="text-align: right;color: red"> <strong>Giảm giá '.$coupon_number.' % trên tổng hóa đơn</strong></td>';
                            echo '<tr>';
                            echo '<td colspan="3"></td>';
                            echo '<td> Tiền giảm:</td>';
                            echo '<td style="text-align: right;color: red"> <strong> -'.number_format($total_coupon,0,',','.').' VNĐ</strong></td>';
                            echo'</tr>';
                          @endphp
                      @else
                          @php
                            $total_coupon = $coupon_number;
                            echo '<td colspan="3"></td>';
                            echo '<td> Nội dung giảm:</td>';
                            echo '<td style="text-align: right;color: red"> <strong>Giảm giá '.$coupon_number.' VNĐ trên tổng hóa đơn</strong></td>';
                            echo '<tr>';
                            echo '<td colspan="3"></td>';
                            echo '<td> Tiền giảm:</td>';
                            echo '<td style="text-align: right;color: red"> <strong> -'.number_format($coupon_number,0,',','.').' VNĐ</strong></td>';
                            echo'</tr>';
                          @endphp
                      @endif
                    </tr>

                    @endif
                    <tr>
                      <td colspan="3"></td>
                      <td> Tiền vận chuyển:</td>
                      <td style="text-align: right;color: red"> <strong>{{number_format($product_feeship).' VNĐ'}}</strong></td>
                    </tr>
                    <tr>
                      <td colspan="3"></td>
                      <td> Tổng tiền thanh toán:</td>
                      <td style="text-align: right;color: red"> <strong>{{number_format($total+$product_feeship-$total_coupon).' VNĐ'}}</strong></td>
                    </tr>
                    <tr>
                      <td style="text-align: center" colspan="2"><strong>Tình trạng đơn hàng: </strong></td>
                      <td colspan="3" style="text-align: center">
                          <div class="form-group">
                            @foreach($order as $key =>$or)
                              @if ($or->order_status == 1)
                              
                                <form>
                                  @csrf
                                  <select class="form-control order_details">
                                    <option selected id="{{$or->order_id}}" value="1">Chờ xác nhận</option>
                                    <option id="{{$or->order_id}}" value="2">Đã xác nhận</option>
                                    <option id="{{$or->order_id}}" value="3">Đang vận chuyển</option>
                                    <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" value="5">Đã hủy</option>
                                  </select>
                                </form>
                              @elseif($or->order_status == 2)
                                 <form>
                                  @csrf
                                  <select class="form-control order_details">
                                    <option id="{{$or->order_id}}" value="1">Chờ xác nhận</option>
                                    <option id="{{$or->order_id}}" selected value="2">Đã xác nhận</option>
                                    <option id="{{$or->order_id}}" value="3">Đang vận chuyển</option>
                                    <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" value="5">Đã hủy</option>
                                  </select>
                                </form>
                              @elseif($or->order_status == 3)
                                 <form>
                                  @csrf
                                  <select class="form-control order_details">
                                    <option  id="{{$or->order_id}}" value="1">Chờ xác nhận</option>
                                    <option id="{{$or->order_id}}" value="2">Đã xác nhận</option>
                                    <option id="{{$or->order_id}}" selected value="3">Đang vận chuyển</option>
                                    <option id="{{$or->order_id}}" value="4">Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" value="5">Đã hủy</option>
                                  </select>
                                </form>
                              @elseif($or->order_status == 4)
                                 <form>
                                  @csrf
                                  <select class="form-control order_details">
                                    <option  id="{{$or->order_id}}" disabled value="1">Chờ xác nhận</option>
                                    <option id="{{$or->order_id}}" disabled value="2">Đã xác nhận</option>
                                    <option id="{{$or->order_id}}" disabled value="3">Đang vận chuyển</option>
                                    <option id="{{$or->order_id}}" selected value="4">Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" disabled value="5">Đã hủy</option>
                                  </select>
                                </form>
                              @else
                                 <form>
                                  @csrf
                                  <select class="form-control order_details">
                                    <option id="{{$or->order_id}}" disabled value="1">Chờ xác nhận</option>
                                    <option id="{{$or->order_id}}" disabled value="2">Đã xác nhận</option>
                                    <option id="{{$or->order_id}}" disabled value="3">Đang vận chuyển</option>
                                    <option id="{{$or->order_id}}" disabled value="4">Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" selected value="5">Đã hủy</option>
                                  </select>
                                </form>
                              @endif
                            @endforeach
                          </div>
                      </td>
                    </tr>
                    
                    @if($quatang==0)
                    <tr>
                        <td colspan="5" style="text-align: center">
                            <a>ĐƠN HÀNG NÀY KHÔNG CÓ QUÀ TẶNG KÈM</a>
                            <br>
                            <button data-toggle="modal" data-target="#modal-xl-addquatang" ui-toggle-class="" type="submit" name="" class="btn btn-warning">Tặng quà</button>
                        </td>
                    </tr>
                    @endif
                    @if($quatang>0)
                    <tr>
                        <td colspan="2" style="text-align: center">ĐƠN HÀNG NÀY CÓ QUÀ TẶNG KÈM LÀ:</td>
                        @foreach($dsquatang as $key => $tenqt)
                        <td colspan="3" style="text-align: center"><strong>{{ $tenqt->quatang_ten }}</strong></td>
                        @endforeach
                    </tr>
                
                    
                    @endif
                    <tr>
                      <td colspan="5" style="text-align: center"><a href="{{URL::to('/print-order/'.$details->order_code)}}" class="btn btn-info"> IN ĐƠN HÀNG</a></td>
                    </tr>
                  </tbody>
                </table>
                    
               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>

<div class="modal fade" id="modal-xl-addquatang">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Chọn quà khuyến mãi tặng kèm</h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                            <form action="{{Url::to('/qua-tang')}}" method="post">
                            {{ csrf_field() }}
                              <table class="table table-bordered">
                                <thead>                  
                                  <tr style="text-align: center">
                                    <th>Tên quà tặng</th>
                                    <th>Số lượng</th>
                                    <th>Xác nhận</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr style="text-align: center">
                                    <td style="text-align: justify;">
                                        <div class="form-group">
                                            <select name="quatang_id" class="form-control is-warning">
                                                  @foreach($all_quatang as $key => $qt)
                                                  <option value="{{$qt->quatang_id}}">{{$qt->quatang_ten}}</option>
                                                  @endforeach
                                            </select>
                              

                                        </div>
                                    </td>
                                    <td>
                                      <div class="input-group">
                                        <input style="text-align: center" type="number" min="0" class="form-control is-warning" value="" name="quatang_sl">
                                      </div>
                                    </td>
                                    <td><button style="submit" class="btn btn-danger">Tặng kèm</button></td>
                                  </tr>
                                </tbody>
                              </table>
                            </form>

                          </div>
                          <!-- /.card-body -->                          
                        </div>
                      </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection