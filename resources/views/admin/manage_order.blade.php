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
              <li class="breadcrumb-item active">Đơn đặt hàng</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
      	
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách đơn đặt hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Tổng hóa đơn</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Trạng thái</th>
                                    <th>Chi tiết</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_order as $key => $order)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td>{{ cutTitle($order->order_code,10) }}</td>
                                        <td>{{ date('d/m/Y h:i:s', strtotime($order->created_at)) }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modal-xl-updatetotalship" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$order->order_id}}',
                                                    total: '{{$order->order_total}}',
                                                    ship: '{{$order->order_ship}}',
                                                })">
                                            {{ number_format($order->order_total).' VNĐ' }}
                                            </a>
                                            </td>
                                        <td><a href="#" data-toggle="modal" data-target="#modal-xl-updatetotalship" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$order->order_id}}',
                                                    total: '{{$order->order_total}}',
                                                    ship: '{{$order->order_ship}}',
                                                })">
                                            {{ number_format($order->order_ship).' VNĐ' }}</a></td>
                                        <td>
                                            <?php
                                                if($order->order_status==1){
                                            ?>
                                                <a href=""><span class="btn btn-warning btn-block btn-flat">Chờ xác nhận</span></a>
                                            <?php
                                                }else if ($order->order_status==2){
                                            ?>
                                                <a href=""><span class="btn btn-secondary btn-block btn-flat"> Đã xác nhận</span></a>
                                            <?php
                                                }else if ($order->order_status==3){
                                            ?>
                                                <a href=""><span class="btn btn-info btn-block btn-flat"> Đang vận chuyển</span></a>
                                                <?php
                                                }else if ($order->order_status==4){
                                            ?>
                                                <a href=""><span class="btn btn-success btn-block btn-flat"> Đã giao hàng</span></a>
                                            <?php
                                                }else if ($order->order_status==5){
                                            ?>
                                                <a href=""><span class="btn btn-danger btn-block btn-flat"> Đã hủy</span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="{{URL::to('/view-order/'.$order->order_code)}}" class="active styling-edit"><i class="fa fa-eye text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/'.$order->order_code)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                              </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<script type="text/javascript">
    const renderDOM = qt => {
        console.log(qt)
        const action = '{!! URL::to('/update-totalship') !!}/' + qt.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("totalEdit").value = qt.total;
        document.getElementById("shipEdit").value = qt.ship;
    }
</script>
<div class="modal fade" id="modal-xl-updatetotalship">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin đơn hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của đơn hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="formEdit" action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Giá trị thu thực tế của đơn hàng </label>
                                        <input id="totalEdit" name="order_total" type="text" class="form-control is-warning" placeholder="Nhập giá trị thực thu của đơn hàng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label> Giá trị thu thực tế từ phí vận chuyển</label>
                                        <input id="shipEdit" name="order_ship" type="text" class="form-control is-warning" placeholder="Nhập giá trị thực thu phí vận chuyển." required>
                                      </div>
                                    </div>
                                    
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-qt" class="btn btn-warning">CẬP NHẬT</button>
                                </div>
                                </form>
                              </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

@endsection