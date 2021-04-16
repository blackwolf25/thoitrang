@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý quản trị viên</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản trị viên</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        <div class="breadcrumb float-sm-right">
        <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="add_manager_backend" class="btn btn-warning">Thêm mới</button>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-md-12">
              <!-- /.card-header -->
              <div class="card-body">
                    <!-- Main content -->
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title">Danh sách quản trị viên</h3>
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
                                    <th>Ảnh đại diện</th>
                                    <th>Ngày tham gia</th>
                                    <th>Trạng thái</th>
                                    <th>Tài khoản</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @php 
                                        $i = 0;
                                  @endphp
                                  @foreach($all_manager as $key => $manager)
                                     @php 
                                        $i++;
                                     @endphp
                                  <tr style="text-align: center;">
                                    <td>{{$i}}</td>
                                    <td>{{ $manager->admin_name }}</td>
                                    <td>
                                        <?php
                                          $dateofbirth_day = date('d-m-Y', strtotime($manager->admin_dateofbirth));
                                          if ($dateofbirth_day =="") {
                                              echo 'Chưa cập nhật';
                                          } echo $dateofbirth_day;
                                          ?>
                                    </td>
                                    <td>{{ $manager->admin_email }}</td>
                                    <td>{{ $manager->admin_phone }}</td>
                                    <td>
                                        <?php
                                          $manager_add = $manager->admin_add;
                                          if ($manager_add =="") {
                                              echo 'Chưa cập nhật';
                                          } echo cutTitle($manager_add,10);
                                          ?>
                                    </td>
                                    <td>
                                      <img height="50" width="50" src="{{asset('public/uploads/images/user/'.$manager->admin_avatar)}}">
                                    </td>
                                    <td>
                                        <?php
                                          $created_day = date('d-m-Y', strtotime($manager->created_at));
                                          if ($created_day) {
                                              echo $created_day;
                                          }
                                          ?>
                                    </td>
                                    <td>
                                        <?php
                                                if($manager->admin_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-manager/'.$manager->admin_id)}}"><span class="fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-manager/'.$manager->admin_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                    </td>
                                    <td>
                                      <?php
                                                if($manager->acount_status==1){
                                            ?>
                                                <a href="{{URL::to('/khoi-phuc-mat-khau/'.$manager->admin_id)}}"><span class="btn btn-warning"> Yêu cầu khôi phục mật khẩu</span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a><span class="btn btn-success"> Đang hoạt động bình thường</span></a>
                                            <?php
                                                }
                                            ?>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                    onclick="renderDOM({ 
                                        id: '{{$manager->admin_id}}',
                                        pass: '{{$manager->admin_password}}',
                                        name: '{{$manager->admin_name}}',
                                        dateofbirth: '{{$manager->admin_dateofbirth}}',
                                        email: '{{$manager->admin_email}}',
                                        phone: '{{$manager->admin_phone}}',
                                        add: '{{$manager->admin_add}}',
                                        status: '{{$manager->admin_status}}',
                                        image: '{{$manager->admin_avatar}}',
                                        type:'{{$manager->admin_type}}',
                                    })"><i class="fa fa-user-edit text-success text-active"></i>
                                </a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Bạn có chắc là muốn xóa quản trị viên này không?')" href="{{URL::to('/delete-manager/'.$manager->admin_id)}}" class="active styling-edit" ui-toggle-class="">
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
              </div>
              <!-- /.card-body -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
    </div>
</section>


<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-manager-backend')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm quản trị viên</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của quản trị viên</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-manager-backend')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Họ và tên</label>
                                        <input name="manager_name" type="text" class="form-control is-warning" placeholder="Nhập họ và tên của quản trị viên." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Mật khẩu</label>
                                        <input name="manager_password" type="password" class="form-control is-warning" placeholder="Nhập mật khẩu." required>
                                      </div>
                                    </div>
                                  
                                  <div class="col-sm-12">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Địa chỉ</label>
                                        <input name="manager_add" type="text" class="form-control is-warning" placeholder="Nhập địa chỉ." required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                     <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Ngày tháng năm sinh</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input  name="manager_dateofbirth"  placeholder="Nhập tháng/ ngày/ năm sinh." type="text" class="form-control datetimepicker-input" data-target="#reservationdate" required/>
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Email</label>
                                        <input name="manager_email" type="text" class="form-control is-warning" placeholder="Nhập email." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Số điện thoại</label>
                                        <input name="manager_phone" type="text" class="form-control is-warning" placeholder="Nhập số điện thoại." required>
                                      </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                            <select name="manager_status" class="form-control is-warning">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                      </div>
                                    </div>
                                    
                                </div>
                                  </div>

                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button type="submit" name="insert-manager-backend" class="btn btn-warning">THÊM MỚI</button>
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
    
    const renderDOM = manager => {
        console.log(manager)
        const action = '{!! URL::to('/update-manager-backend') !!}/' + manager.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("imageEdit").src = 'public/uploads/images/user/' + manager.image;
        document.getElementById("nameEdit").value = manager.name;
        document.getElementById("passwordEdit").innerHTML = manager.pass;
        document.getElementById("dateofbirthEdit").value = manager.dateofbirth;
        document.getElementById("emailEdit").value = manager.email;
        document.getElementById("phoneEdit").value = manager.phone;
        document.getElementById("addEdit").value = manager.add;
        document.getElementById("statusEdit").value = manager.status;
        document.getElementById("typeEdit").value = manager.type;
    }

</script>
<!-- /.modal-dialog -->
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin quản trị viên</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của quản trị viên</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                 <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Loại tài khoản</label>
                                            <select id="typeEdit" name="manager_type" class="form-control is-warning">
                                                <option value="1">Quản trị viên</option>
                                                <option value="2">Cộng tác viên</option>
                                            </select>
                                      </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Tên quản trị viên</label>
                                    <input value="" type="text" class="form-control is-warning" id="nameEdit" name="manager_name" placeholder="Nhập tên quản trị viên..." required/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Mật khẩu</label>
                                    <input value="" type="password" class="form-control is-warning" id="passwordEdit" name="manager_password" placeholder="Nhập mật khẩu..." required/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="inputWarning">Địa chỉ</label>
                                    <input value="" type="text" class="form-control is-warning" id="addEdit" name="manager_add" placeholder="Nhập địa chỉ của quản trị viên..." required/>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Số điện thoại</label>
                                            <input value="" type="text" class="form-control is-warning" id="phoneEdit" name="manager_phone" placeholder="Nhập số điện thoại của quản trị viên..." required/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Email</label>
                                            <input value="" type="text" class="form-control is-warning" id="emailEdit" name="manager_email" placeholder="Nhập email của quản trị viên..." required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-sm-6">
                                      <div class="form-group">
                                        <label class="col-form-label" for="inputWarning">Ngày tháng năm sinh</label>
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                              <input id="dateofbirthEdit" name="manager_dateofbirth"  placeholder="Nhập tháng/ ngày/ năm sinh." type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                              <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Trạng thái</label>
                                            <select id="statusEdit" name="manager_status" class="form-control is-warning">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Hình ảnh đại diện hiện tại</label>
                                            <div>
                                        <img style="width: 100px; align-items: center;" id="imageEdit" src="#">
                                    </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-form-label" for="inputWarning">Cập nhật lại hình ảnh đại diện</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="manager_image" type="file" class="custom-file-input" id="customFile" />
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
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
                    <button type="submit" name="update_manager_backend" class="btn btn-warning">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
@endsection