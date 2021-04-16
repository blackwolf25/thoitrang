@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý liên hệ góp ý của khách hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Liên hệ góp ý của khách hàng</li>
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
                <h3 class="card-title">Danh sách liên hệ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr style="text-align: center;">
                    <th>STT</th>
                    <th>Ngày</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Phản hồi</th>
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                        $i = 0;
                   @endphp
                   @foreach($all_contact as $key => $contact)
                        @php 
                             $i++;
                        @endphp
                  <tr style="text-align: center;">
                    <td>{{$i}}</td>
                    <td>{{date('d/m/y',strtotime($contact->contact_created_at))}}</td>
                    <td>{{$contact->contact_email}}</td>
                    <td>
                    						<?php
                                                if($contact->contact_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-contact/'.$contact->contact_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-contact/'.$contact->contact_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                    </td>
                    <td>
                    	<a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                
                                                    data-id = "{{$contact->contact_id}}"
                                                    data-name = "{{$contact->contact_name}}",
                                                    data-status = "{{$contact->contact_status}}",

                                                    data-phone = "{{$contact->contact_phone}}",

                                                    data-content = "{{$contact->contact_content}}",
                                                    data-email = "{{$contact->contact_email}}",

                                                    data-rep = "{{$contact->contact_rep}}",
                                                onclick="renderDOM(this)"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                    </td>
                    <td><a onclick="return confirm('Bạn có chắc là muốn xóa liên hệ này không?')" href="{{URL::to('/delete-contact/'.$contact->contact_id)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a></td>
                  </tr>
                  @endforeach
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
    const renderDOM = contact => {
        console.log(contact.dataset)
        const action = '{!! URL::to('/update-contact') !!}/' + contact.dataset.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = contact.dataset.name;
        document.getElementById("statusEdit").value = contact.dataset.status;

        document.getElementById("phoneEdit").value = contact.dataset.phone;
        document.getElementById("contentEdit").value = contact.dataset.content;
        document.getElementById("emailEdit").value = contact.dataset.email;

        CKEDITOR.instances.ckeditorcontentedit.setData(contact.dataset.rep);
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Phản hồi góp ý kiến hay liên hệ</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung phản hồi góp ý kiến hay liên hệ</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên khách hàng</label>
                                        <input id="nameEdit" name="contact_name" type="text" class="form-control is-warning" placeholder="" required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                    	<div class="form-group">
                                        <label>Email</label>
                                        <input id="emailEdit" name="contact_mail" type="text" class="form-control is-warning" placeholder="" required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                    	<div class="form-group">
                                        <label>phone</label>
                                        <input id="phoneEdit" name="contact_phone" type="text" class="form-control is-warning" placeholder="" required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                    	<div class="form-group">
                                        <label>Nội dung</label>
                                        <input id="contentEdit" name="contact_content" type="text" class="form-control is-warning" placeholder="" required>
                                      </div>
                                    </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="contact_status" class="form-control is-warning">
                                                  <option value="1">Đã phản hồi</option>
                                                  <option value="0">Chưa phản hồi</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                    	<div class="form-group">
                                        <label>Nội dung đã phản hồi</label>
                                        <textarea id="ckeditorcontentedit" name="contact_rep" type="text" class="form-control is-warning" placeholder="" rows="8"></textarea>
                                      </div>
                                    </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-contact" class="btn btn-warning">CẬP NHẬT</button>
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