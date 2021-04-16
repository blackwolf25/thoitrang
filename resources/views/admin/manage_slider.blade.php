@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý slider</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Slider</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        <div class="breadcrumb float-sm-right">
          <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="" class="btn btn-warning">Thêm mới</button>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách slider</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên slider</th>
                                    <th style="width: 50px;">Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Link</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_slider as $key => $slider)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($slider->slider_name,10) }}</td>
                                        <td><img src="public/uploads/images/slider/{{ $slider->slider_image }}" height="50" width="200" /></td>
                                        <td style="text-align: justify;">{{ cutTitle($slider->slider_desc,10) }}</td>
                                        <td>{{ cutTitle($slider->link,15) }}</td>
                                        <td>
                                            <?php
                                                if($slider->slider_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-slider/'.$slider->slider_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-slider/'.$slider->slider_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$slider->slider_id}}',
                                                    name: '{{$slider->slider_name}}',
                                                    desc: '{{$slider->slider_desc}}',
                                                    image: '{{$slider->slider_image}}',
                                                    status: '{{$slider->slider_status}}',
                                                    link:'{{ $slider->link }}',
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa slider này không?')" href="{{URL::to('/delete-slider/'.$slider->slider_id)}}" class="active styling-edit" ui-toggle-class="">
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
<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-slider')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm slider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của slider</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-slider')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên slider</label>
                                        <input name="slider_name" type="text" class="form-control is-warning" placeholder="Nhập tên của slider." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả slider</label>
                                        <input name="slider_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả slider." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Link</label>
                                        <input name="link" type="text" class="form-control is-warning" placeholder="Nhập đường dẫn của slider." required>
                                      </div>
                                    </div>
                                    	<div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label for="exampleInputFile">Hình ảnh 780 x 300 px </label>
	                                            <div class="input-group">
	                                                <div class="custom-file">
	                                                    <input name="slider_image" type="file" class="custom-file-input" id="customFileImage" required>
	                                                    <label class="custom-file-label" for="customFileImage">Chọn hình ảnh</label>
	                                                </div>
	                                            </div>
	                                      </div>
	                                    </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Trạng thái</label>
	                                            <select name="slider_status" class="form-control is-warning">
	                                                <option value="1">Hiển thị</option>
	                                                <option value="0">Không hiển thị</option>
	                                            </select>
	                                      </div>
	                                    </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-slider" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = slider => {
        console.log(slider)
        const action = '{!! URL::to('/update-slider') !!}/' + slider.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = slider.name;
        document.getElementById("descEdit").value = slider.desc;
        document.getElementById("imageEdit").src = 'public/uploads/images/slider/' + slider.image;
        document.getElementById("statusEdit").value = slider.status;
        document.getElementById("linkEdit").value = slider.link;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin slider</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của slider</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-slider')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên slider</label>
                                        <input id="nameEdit" name="slider_name" type="text" class="form-control is-warning" placeholder="Nhập tên của slider." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả slider</label>
                                        <input id="descEdit" name="slider_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả slider." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Link</label>
                                        <input id="linkEdit" name="link" type="text" class="form-control is-warning" placeholder="Nhập link.">
                                      </div>
                                    </div>
                                    
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Hình ảnh 780 x 480 px</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="slider_image" type="file" class="custom-file-input" id="customFile" />
                                                      <label class="custom-file-label" for="customFile">Chọn hình ảnh</label>
                                                  </div>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Hình ảnh hiện tại</label>
                                          <div>
                                          <img style="width: 100px; align-items: center;" id="imageEdit" src="#">
                                    </div>
                                      </div>
                                      </div>
                                    
                                    
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="slider_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-slider" class="btn btn-warning">CẬP NHẬT</button>
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
