@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý banner</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Banner</li>
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách banner</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên banner</th>
                                    <th style="width: 50px;">Hình ảnh</th>
                                    <th>Mô tả</th>
                                    <th>Vị trí</th>
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
                                @foreach($all_banner as $key => $banner)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($banner->banner_name,10) }}</td>
                                        <td><img src="{{ asset('public/uploads/images/banner/'.$banner->banner_image) }}" height="100" width="200" /></td>
                                        <td style="text-align: justify;">{{ cutTitle($banner->banner_desc,10) }}</td>
                                        <td>
                                            <?php
                                                if($banner->banner_pos=='0'){
                                                  echo "575 x 200 px";
                                                }elseif($banner->banner_pos=='1'){
                                                  echo "Trên";
                                                }elseif($banner->banner_pos=='2'){
                                                  echo "Dưới";
                                                }elseif($banner->banner_pos=='3'){
                                                  echo "Sản phẩm khuyến mãi";
                                                }elseif($banner->banner_pos=='4'){
                                                  echo "Sản phẩm mới";
                                                }else{
                                                  echo "Sản phẩm bán chạy";
                                                }
                                            ?>
                                        </td>
                                        <td>{{ cutTitle($banner->link,15) }}</td>
                                        <td>
                                            <?php
                                                if($banner->banner_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-banner/'.$banner->banner_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-banner/'.$banner->banner_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$banner->banner_id}}',
                                                    name: '{{$banner->banner_name}}',
                                                    desc: '{{$banner->banner_desc}}',
                                                    image: '{{$banner->banner_image}}',
                                                    pos: '{{$banner->banner_pos}}',
                                                    status: '{{$banner->banner_status}}',
                                                    link:'{{ $banner->link }}',
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa banner này không?')" href="{{URL::to('/delete-banner/'.$banner->banner_id)}}" class="active styling-edit" ui-toggle-class="">
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
            <form action="{{URL::to('/insert-banner')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của banner</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-banner')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên banner</label>
                                        <input name="banner_name" type="text" class="form-control is-warning" placeholder="Nhập tên của banner." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả banner</label>
                                        <input name="banner_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả banner." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Link</label>
                                        <input name="link" type="text" class="form-control is-warning" placeholder="Nhập đường dẫn của banner." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Hình ảnh</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="banner_image" type="file" class="custom-file-input" id="customFileImage" required/>
                                                      <label class="custom-file-label" for="customFileImage">Chọn hình ảnh</label>
                                                  </div>
                                              </div>
                                        </div>
                                      </div>
                                    
                                    	<div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Vị trí đặt banner</label>
                                              <select name="banner_pos" class="form-control is-warning">
                                                  <option value="0">575 x 200 px</option>
                                                  <option value="1">Trên 1200 x .. px</option>
                                                  <option value="2">Dưới 1200 x .. px</option>
                                                  <option value="3">Sản phẩm khuyến mãi 575 x 200 px</option>
                                                  <option value="4">Sản phẩm mới 575 x 200 px</option>
                                                  <option value="5">Sản phẩm bán chạy 575 x 200 px</option>
                                              </select>
                                        </div>
                                      </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Trạng thái</label>
	                                            <select name="banner_status" class="form-control is-warning">
	                                                <option value="1">Hiển thị</option>
	                                                <option value="0">Không hiển thị</option>
	                                            </select>
	                                      </div>
	                                    </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-banner" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = banner => {
        console.log(banner)
        const action = '{!! URL::to('/update-banner') !!}/' + banner.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = banner.name;
        document.getElementById("descEdit").value = banner.desc;
        document.getElementById("imageEdit").src = 'public/uploads/images/banner/' + banner.image;
        document.getElementById("statusEdit").value = banner.status;
        document.getElementById("posEdit").value = banner.pos;
        document.getElementById("linkEdit").value = banner.link;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin banner</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của banner</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-banner')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên banner</label>
                                        <input id="nameEdit" name="banner_name" type="text" class="form-control is-warning" placeholder="Nhập tên của banner." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả banner</label>
                                        <input id="descEdit" name="banner_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả banner." required>
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
                                          <label for="exampleInputFile">Hình ảnh</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="banner_image" type="file" class="custom-file-input" id="customFile" />
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
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Vị trí đặt banner</label>
                                              <select id="posEdit" name="banner_pos" class="form-control is-warning">
                                                  <option value="0">575 x 200 px</option>
                                                  <option value="1">Trên 1200 x .. px</option>
                                                  <option value="2">Dưới 1200 x .. px</option>
                                                  <option value="3">Sản phẩm khuyến mãi 575 x 200 px</option>
                                                  <option value="4">Sản phẩm mới 575 x 200 px</option>
                                                  <option value="5">Sản phẩm bán chạy 575 x 200 px</option>
                                              </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="banner_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-banner" class="btn btn-warning">CẬP NHẬT</button>
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
