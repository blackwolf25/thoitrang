@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý khuyến mãi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Khuyến mãi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
          <div class="col-12">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Quản lý khuyến mãi</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Voucher khuyến mãi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Sản phẩm khuyến mãi</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                             <section class="content">
                              <div class="container-fluid">
                                <div>
                                <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="add_customer_backend" class="btn btn-danger">Thêm mới</button>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-12">
                                    <div class="card">
                                      <div class="card-header">
                                        <h3 class="card-title">Danh sách mã khuyến mãi</h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body">
                                        <table id="example1" class="table table-bordered table-hover">
                                         <thead style="text-align: center;">
                                                          <tr>
                                                            <th style="width: 10px;">STT</th>
                                                            <th>Tên mã khuyến mãi</th>
                                                            <th>Mã khuyến mãi</th>
                                                            <th>Hình thức khuyến mãi</th>
                                                            <th>Nội dung khuyến mãi</th>
                                                            <th>Trạng thái</th>
                                                            <th>Sửa</th>
                                                            <th>Xóa</th>                            
                                                          </tr>
                                                      </thead>
                                                      <tbody tyle="text-align: center;">
                                                        @php 
                                                            $i = 0;
                                                        @endphp
                                                        @foreach($coupon as $key => $coupon)
                                                            @php 
                                                                $i++;
                                                            @endphp
                                                            <tr style="text-align: center; align-self: center;">
                                                                <td>{{$i}}</td>
                                                                <td style="text-align: left;">{{ cutTitle($coupon->coupon_name,10) }}</td>
                                                                <td style="text-align: center;">{{ $coupon->coupon_code }}</td>
                                                                <td style="text-align: left;">
                                                                  <?php
                                                                  if( $coupon->coupon_condition == 0 ){ ?>Miễn phí vận chuyển
                                                                  <?php }elseif ($coupon->coupon_condition ==1) {
                                                                   ?>Giảm theo % trên tổng hóa đơn
                                                                   <?php 
                                                                  }else{
                                                                  ?>Giảm trực tiếp số tiền trên tổng hóa đơn
                                                                  <?php }
                                                                  ?>
                                                                </td>
                                                                <td style="text-align: left;">
                                                                  <?php
                                                                  if( $coupon->coupon_condition == 0 ){ ?>Miễn phí vận chuyển
                                                                  <?php }elseif ($coupon->coupon_condition ==1) {
                                                                   ?>Giảm {{ $coupon->coupon_number }} % trên tổng hóa đơn
                                                                   <?php 
                                                                  }else{
                                                                  ?>Giảm trực tiếp {{ number_format($coupon->coupon_number) }}  VNĐ trên tổng hóa đơn
                                                                  <?php }
                                                                  ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        if($coupon->coupon_status==1){
                                                                    ?>
                                                                        <a href="{{URL::to('/unactive-coupon/'.$coupon->coupon_id)}}"><span class=" fa fa-eye"></span></a>
                                                                    <?php
                                                                        }else{
                                                                    ?>
                                                                        <a href="{{URL::to('/active-coupon/'.$coupon->coupon_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                  <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                                        onclick="renderDOM({ 
                                                                            id: '{{$coupon->coupon_id}}',
                                                                            name: '{{$coupon->coupon_name}}',
                                                                            code: '{{$coupon->coupon_code}}',
                                                                            number: '{{$coupon->coupon_number}}',
                                                                            condition: '{{$coupon->coupon_condition}}',
                                                                            status: '{{$coupon->coupon_status}}',
                                                                        })"><i class="fa fa-edit text-success text-active"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a onclick="return confirm('Bạn có chắc là muốn xóa coupon này không?')" href="{{URL::to('/delete-coupon/'.$coupon->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
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
                              <!-- /.container-fluid -->
                            </section>
                            <!-- /.content -->
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
                    <div>
                                <button data-toggle="modal" data-target="#modal-xl-add-khuyenmai" ui-toggle-class="" type="submit" name="add_customer_backend" class="btn btn-danger">Thêm mới</button>
                                </div>
                                <br>
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Danh sách sản phẩm khuyến mãi</h3>

                            <div class="card-tools">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body table-responsive p-0" style="height: 550px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead style="text-align: center;">
                                <tr>
                                  <th>STT</th>
                                  <th>Tên sản phẩm</th>
                                  <th>Giá khuyến mãi</th>
                                  <th>Nổi bật</th>
                                  <th>Trạng thái</th>
                                  <th>Sửa</th>
                                  <th>Xóa</th>
                                </tr>
                              </thead>
                              <tbody>
                                 @php 
                                                            $i = 0;
                                                        @endphp
                                                        @foreach($product_khuyenmai as $key => $khuyenmai)
                                                            @php 
                                                                $i++;
                                                            @endphp
                                <tr style="text-align: center; align-self: center;">
                                  <td>{{ $i }}</td>
                                  <td>{{ $khuyenmai->product_name}}</td>
                                  <td> {{number_format( $khuyenmai->khuyenmai_gia )}} VNĐ</td>
                                  <td>
                                                                    <?php
                                                                        if($khuyenmai->khuyenmai_noibat==1){
                                                                    ?>
                                                                        <a href="{{URL::to('/unactive-khuyenmainb/'.$khuyenmai->khuyenmai_id)}}"><span class=" fa fa-eye"></span></a>
                                                                    <?php
                                                                        }else{
                                                                    ?>
                                                                        <a href="{{URL::to('/active-khuyenmainb/'.$khuyenmai->khuyenmai_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                  <td>
                                                                    <?php
                                                                        if($khuyenmai->khuyenmai_status==1){
                                                                    ?>
                                                                        <a href="{{URL::to('/unactive-khuyenmai/'.$khuyenmai->khuyenmai_id)}}"><span class=" fa fa-eye"></span></a>
                                                                    <?php
                                                                        }else{
                                                                    ?>
                                                                        <a href="{{URL::to('/active-khuyenmai/'.$khuyenmai->khuyenmai_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                  <a href="#" data-toggle="modal" data-target="#modal-xl-update-khuyenmai" class="active styling-edit" ui-toggle-class=""
                                                                        onclick="renderDOM1({ 
                                                                            id: '{{$khuyenmai->khuyenmai_id}}',
                                                                            product: '{{$khuyenmai->product_id}}',
                                                                            gia: '{{$khuyenmai->khuyenmai_gia}}',

                                                                            status: '{{$khuyenmai->khuyenmai_status}}',
                                                                            noibat: '{{$khuyenmai->khuyenmai_noibat}}',
                                                                        })"><i class="fa fa-edit text-success text-active"></i>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a onclick="return confirm('Bạn có chắc là muốn xóa khuyenmai này không?')" href="{{URL::to('/delete-khuyenmai/'.$khuyenmai->khuyenmai_id)}}" class="active styling-edit" ui-toggle-class="">
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
                    </div>
                    <!-- /.row -->
                  </div><!-- /.container-fluid -->
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
   
<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-coupon')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm coupon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-coupon')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên coupon</label>
                                        <input name="coupon_name" type="text" class="form-control is-warning" placeholder="Nhập tên của coupon." required>
                                      </div>
                                    </div>
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Mã coupon</label>
                                        <input name="coupon_code" type="text" class="form-control is-warning" placeholder="Nhập mã coupon." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Giá trị coupon</label>
                                        <input name="coupon_number" type="text" class="form-control is-warning" placeholder="Nhập giá trị  coupon." required>
                                      </div>
                                    </div>
                                    
                                    	<div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Hình thức khuyến mãi</label>
                                              <select name="coupon_condition" class="form-control is-warning">
                                                  <option value="0">Miễn phí vận chuyển</option>
                                                  <option value="1">Giảm theo % trên tổng hóa đơn</option>
                                                  <option value="2">Giảm trực tiếp số tiền trên tổng hóa đơn</option>
                                              </select>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Trạng thái</label>
	                                            <select name="coupon_status" class="form-control is-warning">
	                                                <option value="1">Hiển thị</option>
	                                                <option value="0">Không hiển thị</option>
	                                            </select>
	                                      </div>
	                                    </div>
                                      
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-coupon" class="btn btn-warning">THÊM MỚI</button>
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
<script type="text/javascript">
    const renderDOM = coupon => {
        console.log(coupon)
        const action = '{!! URL::to('/update-coupon') !!}/' + coupon.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = coupon.name;
        document.getElementById("codeEdit").value = coupon.code;
        document.getElementById("statusEdit").value = coupon.status;
        document.getElementById("numberEdit").value = coupon.number;
        document.getElementById("conditionEdit").value = coupon.condition;
        document.getElementById("expEdit").value = coupon.exp;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin coupon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của coupon</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-coupon')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên coupon</label>
                                        <input id="nameEdit" name="coupon_name" type="text" class="form-control is-warning" placeholder="Nhập tên của coupon." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Mã coupon</label>
                                        <input id="codeEdit" name="coupon_code" type="text" class="form-control is-warning" placeholder="Nhập mã của coupon." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Nội dung</label>
                                        <input id="numberEdit" name="coupon_number" type="text" class="form-control is-warning" placeholder="Nhập giá trị của coupon." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Hình thức khuyến mãi</label>
                                              <select id="conditionEdit" name="coupon_condition" class="form-control is-warning">
                                                  <option value="0">Miễn phí vận chuyển</option>
                                                  <option value="1">Giảm theo % trên tổng hóa đơn</option>
                                                  <option value="2">Giảm trực tiếp số tiền trên tổng hóa đơn</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="coupon_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-coupon" class="btn btn-warning">CẬP NHẬT</button>
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


<div class="modal fade" id="modal-xl-add-khuyenmai">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-khuyenmai')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sản phẩm khuyến mãi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của sản phẩm khuyến mãi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-khuyenmai')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên sản phẩm khuyến mãi</label>
                                          <select name="product_id" class="form-control is-warning">
                                                   @foreach($all_product as $key => $product)
                                                <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                                                @endforeach
                                              </select>
                                        

                                      </div>
                                    </div>
                                     <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Giá khuyến mãi</label>
                                        <input name="khuyenmai_gia" type="text" class="form-control is-warning" placeholder="Nhập giá khuyến mãi của sản phẩm khuyến mãi." required>
                                      </div>
                                    </div>                                    
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select name="khuyenmai_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Nổi bật</label>
                                              <select name="khuyenmai_noibat" class="form-control is-warning">
                                                  <option value="1">Có</option>
                                                  <option value="0">Không</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-khuyenmai" class="btn btn-warning">THÊM MỚI</button>
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
<script type="text/javascript">
    const renderDOM1 = khuyenmai => {
        console.log(khuyenmai)
        const action = '{!! URL::to('/update-khuyenmai') !!}/' + khuyenmai.id;
        document.getElementById("formkhuyenmaiEdit").action = action;
        document.getElementById("productEdit").value = khuyenmai.product;
        document.getElementById("giaEdit").value = khuyenmai.gia;
        document.getElementById("statuskhuyenmaiEdit").value = khuyenmai.status;
        document.getElementById("noibatEdit").value = khuyenmai.noibat;

    }
</script>
<div class="modal fade" id="modal-xl-update-khuyenmai">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formkhuyenmaiEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin sản phẩm khuyến mãi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của sản phẩm khuyến mãi</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-khuyenmai')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên sản phẩm khuyến mãi</label>
                                          <select id="productEdit" name="product_id" class="form-control is-warning">
                                                   @foreach($all_product as $key => $product)
                                                <option value="{{$product->product_id}}">{{$product->product_name}}</option>
                                                @endforeach
                                              </select>
                                        

                                      </div>
                                    </div>
                                     <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Giá khuyến mãi</label>
                                        <input id="giaEdit" name="khuyenmai_gia" type="text" class="form-control is-warning" placeholder="Nhập giá khuyến mãi của sản phẩm khuyến mãi." required>
                                      </div>
                                    </div>
                                    
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statuskhuyenmaiEdit" name="khuyenmai_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Nổi bật</label>
                                              <select id="noibatEdit" name="khuyenmai_noibat" class="form-control is-warning">
                                                  <option value="1">Có</option>
                                                  <option value="0">Không</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-khuyenmai" class="btn btn-warning">CẬP NHẬT</button>
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
