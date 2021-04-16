@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý cước phí vận chuyển</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cước phí vận chuyển</li>
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
             <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin tính phí vận chuyển</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Thành phố / Tỉnh </label>
                                              <select name="city" id="city" class="form-control is-warning choose city">
                                                  <option value="">----- Chọn Tỉnh / Thành phố -----</option>
                                                  @foreach($city as $key => $ci)
                                                  <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                  @endforeach
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Quận / Huyện / Thị xã </label>
                                              <select name="province" id="province" class="form-control is-warning province choose">
                                                  <option value="">----- Chọn Quận / Huyện / Thị xã -----</option>

                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Phường/ Xã / Thị trấn </label>
                                              <select name="wards" id="wards" class="form-control is-warning wards">
                                                  <option value="">----- Chọn Phường/ Xã / Thị trấn -----</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Phí vận chuyển</label>
                                          <input name="fee_ship" type="text" class="form-control is-warning fee_ship" placeholder="Nhập phí vận chuyển." required>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" name="add_delivery" class="btn btn-success btn-block add_delivery">THÊM MỚI</button>
                                </div>
                                </form>
                              </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
             </div>
        </div>
        <div style="text-align: center;" id="error_feeship"></div>
		    <br>
        <div id="load_delivery">
          
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>

@endsection
