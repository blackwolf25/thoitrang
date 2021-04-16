@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý khách hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Khách hàng</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        <div class="breadcrumb float-sm-right">
          <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="add_customer_backend" class="btn btn-warning">Thêm mới</button>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Danh sách khách hàng</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Toàn bộ khách hàng</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Khách hàng mới</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Khách hàng phổ thông</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Khách hàng thân thiết</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Toàn bộ khách hàng</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                          <thead>
                                          <tr style="text-align: center;">
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày tham gia</th>
                                            <th>Hạng khách</th>
                                            <th>Chăm sóc viên</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @php 
                                        $i = 0;
                                  @endphp
                                  @foreach($all_customer as $key => $customer)
                                     @php 
                                        $i++;
                                     @endphp
                                          <tr style="text-align: center;">
                                            <td>{{$i}}</td>
                                            <td>{{ $customer->customer_name }}</td>
                                        <td>
                                          <?php
                                              $dateofbirth_day = date('d/m/Y', strtotime($customer->customer_dateofbirth));
                                              if ($dateofbirth_day =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo $dateofbirth_day;
                                              ?>
                                        </td>
                                        <td>{{ $customer->customer_email }}</td>
                                        <td>{{ $customer->customer_phone }}</td>
                                        <td>
                                          <?php
                                              $customer_add = $customer->customer_add;
                                              if ($customer_add =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo cutTitle($customer_add,10);
                                              ?>
                                        </td>
                                        <td>
                                          <?php
                                              $created_day = date('d/m/Y', strtotime($customer->created_at));
                                              if ($created_day) {
                                                  echo $created_day;
                                              }
                                              ?>
                                        </td>
                                        <td>
                                         <?php
                                                                if($customer->customer_vip==0){
                                                            ?>
                                                                <a href=""><span class="badge badge-info">Khách hàng mới</span></a>
                                                            <?php
                                                                }else if($customer->customer_vip==1){
                                                            ?>
                                                                <a href=""><span class="badge badge-warning">Khách hàng phổ thông</span></a>
                                                            <?php
                                                                } else{
                                                            ?>
                                                                <a href=""><span class="badge badge-danger">Khách hàng thân thiết</span></a>
                                                            <?php
                                                                }
                                                            ?>
                                        </td> 
                                        </td>
                                        <td>{{ $customer->admin_name}}</td>
                                        <td>
                                          <?php
                                                                if($customer->customer_status==1){
                                                            ?>
                                                                <a href="{{URL::to('/unactive-customer/'.$customer->customer_id)}}"><span class="fa fa-eye"></span></a>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <a href="{{URL::to('/active-customer/'.$customer->customer_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                            <?php
                                                                }
                                                            ?>
                                        </td>

                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                    onclick="renderDOM({ 
                                                        id: '{{$customer->customer_id}}',
                                                        pass: '{{$customer->customer_password}}',
                                                        name: '{{$customer->customer_name}}',
                                                        dateofbirth: '{{$customer->customer_dateofbirth}}',
                                                        email: '{{$customer->customer_email}}',
                                                        phone: '{{$customer->customer_phone}}',
                                                        add: '{{$customer->customer_add}}',
                                                        status: '{{$customer->customer_status}}',
                                                        admin: '{{$customer->admin_id}}',
                                                        vip: '{{$customer->customer_vip}}',
                                                    })"><i class="fa fa-user-edit text-success text-active"></i>
                                                </a>
                                        </td>
                                        <td>
                                          @if ($customer->customer_id!=1)
                                          
                                          <a onclick="return confirm('Bạn có chắc là muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/'.$customer->customer_id)}}" class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                          </a>
                                        </td>
                                        @endif
                                          </tr>
                                          @endforeach
                                              </tbody>
                                      </table>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Danh sách khách hàng mới</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0" style="height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                          <thead>
                                          <tr style="text-align: center;">
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày tham gia</th>
                                            <th>Chăm sóc viên</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @php 
                                        $i = 0;
                                  @endphp
                                  @foreach($all_customer_new as $key => $customer0)
                                     @php 
                                        $i++;
                                     @endphp
                                          <tr style="text-align: center;">
                                            <td>{{$i}}</td>
                                            <td>{{ $customer0->customer_name }}</td>
                                        <td>
                                          <?php
                                              $dateofbirth_day = date('d/m/Y', strtotime($customer0->customer_dateofbirth));
                                              if ($dateofbirth_day =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo $dateofbirth_day;
                                              ?>
                                        </td>
                                        <td>{{ $customer0->customer_email }}</td>
                                        <td>{{ $customer0->customer_phone }}</td>
                                        <td>
                                          <?php
                                              $customer_add = $customer0->customer_add;
                                              if ($customer_add =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo cutTitle($customer_add,10);
                                              ?>
                                        </td>
                                        <td>
                                          <?php
                                              $created_day = date('d/m/Y', strtotime($customer0->created_at));
                                              if ($created_day) {
                                                  echo $created_day;
                                              }
                                              ?>
                                        </td>
                                        
                                        <td>{{ $customer0->admin_name}}</td>
                                        <td>
                                          <?php
                                                                if($customer0->customer_status==1){
                                                            ?>
                                                                <a href="{{URL::to('/unactive-customer/'.$customer0->customer_id)}}"><span class="fa fa-eye"></span></a>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <a href="{{URL::to('/active-customer/'.$customer0->customer_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                            <?php
                                                                }
                                                            ?>
                                        </td>

                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                    onclick="renderDOM({ 
                                                        id: '{{$customer0->customer_id}}',
                                                        pass: '{{$customer0->customer_password}}',
                                                        name: '{{$customer0->customer_name}}',
                                                        dateofbirth: '{{$customer0->customer_dateofbirth}}',
                                                        email: '{{$customer0->customer_email}}',
                                                        phone: '{{$customer0->customer_phone}}',
                                                        add: '{{$customer0->customer_add}}',
                                                        status: '{{$customer0->customer_status}}',
                                                        admin: '{{$customer0->admin_id}}',
                                                        vip: '{{$customer0->customer_vip}}',
                                                    })"><i class="fa fa-user-edit text-success text-active"></i>
                                                </a>
                                        </td>
                                        <td>
                                          <a onclick="return confirm('Bạn có chắc là muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/'.$customer0->customer_id)}}" class="active styling-edit" ui-toggle-class="">
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
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Danh sách khách hàng phổ thông</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0" style="height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                          <thead>
                                          <tr style="text-align: center;">
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày tham gia</th>
                                            <th>Chăm sóc viên</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @php 
                                        $i = 0;
                                  @endphp
                                  @foreach($all_customer_thuong as $key => $customer1)
                                     @php 
                                        $i++;
                                     @endphp
                                          <tr style="text-align: center;">
                                            <td>{{$i}}</td>
                                            <td>{{ $customer1->customer_name }}</td>
                                        <td>
                                          <?php
                                              $dateofbirth_day = date('d/m/Y', strtotime($customer1->customer_dateofbirth));
                                              if ($dateofbirth_day =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo $dateofbirth_day;
                                              ?>
                                        </td>
                                        <td>{{ $customer1->customer_email }}</td>
                                        <td>{{ $customer1->customer_phone }}</td>
                                        <td>
                                          <?php
                                              $customer_add = $customer1->customer_add;
                                              if ($customer_add =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo cutTitle($customer_add,10);
                                              ?>
                                        </td>
                                        <td>
                                          <?php
                                              $created_day = date('d/m/Y', strtotime($customer1->created_at));
                                              if ($created_day) {
                                                  echo $created_day;
                                              }
                                              ?>
                                        </td>
                                       
                                        <td>{{ $customer1->admin_name}}</td>
                                        <td>
                                          <?php
                                                                if($customer1->customer_status==1){
                                                            ?>
                                                                <a href="{{URL::to('/unactive-customer/'.$customer1->customer_id)}}"><span class="fa fa-eye"></span></a>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <a href="{{URL::to('/active-customer/'.$customer1->customer_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                            <?php
                                                                }
                                                            ?>
                                        </td>

                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                    onclick="renderDOM({ 
                                                        id: '{{$customer1->customer_id}}',
                                                        pass: '{{$customer1->customer_password}}',
                                                        name: '{{$customer1->customer_name}}',
                                                        dateofbirth: '{{$customer1->customer_dateofbirth}}',
                                                        email: '{{$customer1->customer_email}}',
                                                        phone: '{{$customer1->customer_phone}}',
                                                        add: '{{$customer1->customer_add}}',
                                                        status: '{{$customer1->customer_status}}',
                                                        admin: '{{$customer1->admin_id}}',
                                                        vip: '{{$customer1->customer_vip}}',
                                                    })"><i class="fa fa-user-edit text-success text-active"></i>
                                                </a>
                                        </td>
                                        <td>
                                          <a onclick="return confirm('Bạn có chắc là muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/'.$customer1->customer_id)}}" class="active styling-edit" ui-toggle-class="">
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
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_4">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Danh sách khách hàng thân thiết</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive p-0" style="height: 500px;">
                                        <table class="table table-head-fixed text-nowrap">
                                          <thead>
                                          <tr style="text-align: center;">
                                            <th>STT</th>
                                            <th>Họ và tên</th>
                                            <th>Ngày sinh</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Ngày tham gia</th>
                                            <th>Chăm sóc viên</th>
                                            <th>Trạng thái</th>
                                            <th>Sửa</th>
                                            <th>Xóa</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @php 
                                        $i = 0;
                                  @endphp
                                  @foreach($all_customer_vip as $key => $customer2)
                                     @php 
                                        $i++;
                                     @endphp
                                          <tr style="text-align: center;">
                                            <td>{{$i}}</td>
                                            <td>{{ $customer2->customer_name }}</td>
                                        <td>
                                          <?php
                                              $dateofbirth_day = date('d/m/Y', strtotime($customer2->customer_dateofbirth));
                                              if ($dateofbirth_day =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo $dateofbirth_day;
                                              ?>
                                        </td>
                                        <td>{{ $customer2->customer_email }}</td>
                                        <td>{{ $customer2->customer_phone }}</td>
                                        <td>
                                          <?php
                                              $customer_add = $customer2->customer_add;
                                              if ($customer_add =="") {
                                                  echo 'Chưa cập nhật';
                                              } echo cutTitle($customer_add,10);
                                              ?>
                                        </td>
                                        <td>
                                          <?php
                                              $created_day = date('d/m/Y', strtotime($customer2->created_at));
                                              if ($created_day) {
                                                  echo $created_day;
                                              }
                                              ?>
                                        </td>
                                        
                                        <td>{{ $customer2->admin_name}}</td>
                                        <td>
                                          <?php
                                                                if($customer2->customer_status==1){
                                                            ?>
                                                                <a href="{{URL::to('/unactive-customer/'.$customer2->customer_id)}}"><span class="fa fa-eye"></span></a>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                <a href="{{URL::to('/active-customer/'.$customer2->customer_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                            <?php
                                                                }
                                                            ?>
                                        </td>

                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                    onclick="renderDOM({ 
                                                        id: '{{$customer2->customer_id}}',
                                                        pass: '{{$customer2->customer_password}}',
                                                        name: '{{$customer2->customer_name}}',
                                                        dateofbirth: '{{$customer2->customer_dateofbirth}}',
                                                        email: '{{$customer2->customer_email}}',
                                                        phone: '{{$customer2->customer_phone}}',
                                                        add: '{{$customer2->customer_add}}',
                                                        status: '{{$customer2->customer_status}}',
                                                        admin: '{{$customer2->admin_id}}',
                                                        vip: '{{$customer2->customer_vip}}',
                                                    })"><i class="fa fa-user-edit text-success text-active"></i>
                                                </a>
                                        </td>
                                        <td>
                                          <a onclick="return confirm('Bạn có chắc là muốn xóa khách hàng này không?')" href="{{URL::to('/delete-customer/'.$customer2->customer_id)}}" class="active styling-edit" ui-toggle-class="">
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
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
                      </div>
                      <!-- /.container-fluid -->
                    </section>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- ./card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- END CUSTOM TABS -->
  </div>
</section>


<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-customer-backend')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm khách hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của khách hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-customer-backend')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Họ và tên</label>
                                        <input name="customer_name" type="text" class="form-control is-warning" placeholder="Nhập họ và tên của khách hàng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Mật khẩu</label>
                                        <input name="customer_password" type="password" class="form-control is-warning" placeholder="Nhập mật khẩu." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Ngày tháng năm sinh</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input  name="customer_dateofbirth" placeholder="Nhập tháng/ ngày/ năm sinh" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" required/>
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Email</label>
                                        <input name="customer_email" type="text" class="form-control is-warning" placeholder="Nhập email." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Số điện thoại</label>
                                        <input name="customer_phone" type="text" class="form-control is-warning" placeholder="Nhập số điện thoại." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Địa chỉ</label>
                                        <input name="customer_add" type="text" class="form-control is-warning" placeholder="Nhập địa chỉ." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Chăm sóc viên</label>
                                            <select name="admin_id" class="form-control is-warning">
                                                @foreach($admin as $key => $ad)
                                                <option value="{{$ad->admin_id}}">{{$ad->admin_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                            <select name="customer_status" class="form-control is-warning">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-4">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Hạng khách hàng</label>
                                            <select name="customer_vip" class="form-control is-warning">
                                                <option value="0">Mới</option>
                                                <option value="1">Phổ thông</option>
                                                <option value="2">Thân thiết</option>
                                            </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button type="submit" name="insert-customer-backend" class="btn btn-warning">THÊM MỚI</button>
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
      </div>
      <!-- /.container-fluid -->
<script type="text/javascript">
    
    const renderDOM = customer => {
        console.log(customer)
        const action = '{!! URL::to('/update-customer-backend') !!}/' + customer.id;
        document.getElementById("formEdit").action = action;

        document.getElementById("nameEdit").value = customer.name;
        document.getElementById("passwordEdit").innerHTML = customer.pass;
        document.getElementById("dateofbirthEdit").value = customer.dateofbirth;
        document.getElementById("emailEdit").value = customer.email;
        document.getElementById("phoneEdit").value = customer.phone;
        document.getElementById("addEdit").value = customer.add;
        document.getElementById("statusEdit").value = customer.status;
        document.getElementById("adminEdit").value = customer.admin;
        document.getElementById("vipEdit").value = customer.vip;
    }

</script>
<!-- /.modal-dialog -->
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin khách hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của khách hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Tên khách hàng</label>
                                    <input value="" type="text" class="form-control is-warning" id="nameEdit" name="customer_name" placeholder="Nhập tên khách hàng..." required/>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Mật khẩu</label>
                                    <input value="" type="password" class="form-control is-warning" id="passwordEdit" name="customer_password" placeholder="Nhập mật khẩu..." required/>
                                </div>
                                </div>
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Địa chỉ</label>
                                    <input value="" type="text" class="form-control is-warning" id="addEdit" name="customer_add" placeholder="Nhập địa chỉ của khách hàng..." required/>
                                </div>
                                </div>

                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Email</label>
                                            <input value="" type="text" class="form-control is-warning" id="emailEdit" name="customer_email" placeholder="Nhập email của khách hàng..." required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Số điện thoại</label>
                                            <input value="" type="text" class="form-control is-warning" id="phoneEdit" name="customer_phone" placeholder="Nhập số điện thoại của khách hàng..." required/>
                                        </div>
                                    </div>
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Ngày tháng năm sinh</label>
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                              <input id="dateofbirthEdit" name="customer_dateofbirth" placeholder="Nhập tháng/ ngày/ năm sinh." type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                              <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Chăm sóc viên</label>
                                            <select id="adminEdit" name="admin_id" class="form-control is-warning">
                                                @foreach($admin as $key => $ad)
                                                    <option value="{{$ad->admin_id}}">{{$ad->admin_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                	
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                            <select id="statusEdit" name="customer_status" class="form-control is-warning">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                        </div>
                                    </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Hạng khách hàng</label>
                                            <select id="vipEdit" name="customer_vip" class="form-control is-warning">
                                                <option value="0">Mới</option>
                                                <option value="1">Phổ thông</option>
                                                <option value="2">Thân thiết</option>
                                            </select>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" name="update_customer_backend" class="btn btn-warning">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection