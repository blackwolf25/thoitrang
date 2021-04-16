@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý Nhà sản xuất sản phẩm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Nhà sản xuất sản phẩm</li>
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
                <h3 class="card-title">Danh sách Nhà sản xuất hay nhà sản xuất</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên Nhà sản xuất</th>
                                    <th>Mô tả</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_brand_product as $key => $brand)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($brand->brand_name,10) }}</td>
                                        <td style="text-align: justify;">{{ cutTitle($brand->brand_desc,10) }}</td>
                                        <td><img src="public/uploads/images/brand/{{ $brand->brand_image }}" height="50px" width="145px" /></td>
                                        <td>
                                            <?php
                                                if($brand->brand_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-brand-product/'.$brand->brand_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-brand-product/'.$brand->brand_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$brand->brand_id}}',
                                                    name: '{{$brand->brand_name}}',
                                                    desc: '{{$brand->brand_desc}}',
                                                    image: '{{$brand->brand_image}}',
                                                    status: '{{$brand->brand_status}}', 
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa Nhà sản xuất hay nhà sản xuất này không?')" href="{{URL::to('/delete-brand-product/'.$brand->brand_id)}}" class="active styling-edit" ui-toggle-class="">
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
            <form action="{{URL::to('/insert-brand-product')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới Nhà sản xuất hay nhà sản xuất</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của Nhà sản xuất hay nhà sản xuất</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-brand')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên brand</label>
                                        <input name="brand_product_name" type="text" class="form-control is-warning" placeholder="Nhập tên của Nhà sản xuất hay nhà sản xuất." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả brand</label>
                                        <input name="brand_product_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả Nhà sản xuất hay nhà sản xuất." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hình ảnh 870 x 200 px</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="brand_image" type="file" class="custom-file-input" id="customFile1" />
                                                    <label class="custom-file-label" for="customFile1">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Trạng thái</label>
	                                            <select name="brand_product_status" class="form-control is-warning">
	                                                <option value="1">Hiển thị</option>
	                                                <option value="0">Không hiển thị</option>
	                                            </select>
	                                      </div>
	                                    </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-brand-product" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = brand => {
        console.log(brand)
        const action = '{!! URL::to('/update-brand-product') !!}/' + brand.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = brand.name;
        document.getElementById("descEdit").value = brand.desc;
        document.getElementById("statusEdit").value = brand.status;
        document.getElementById("imageEdit").src = 'public/uploads/images/brand/' + brand.image;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin Nhà sản xuất hay nhà sản xuất</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của Nhà sản xuất hay nhà sản xuất</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên Nhà sản xuất hay nhà sản xuất</label>
                                        <input id="nameEdit" name="brand_product_name" type="text" class="form-control is-warning" placeholder="Nhập tên của Nhà sản xuất hay nhà sản xuất." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả Nhà sản xuất hay nhà sản xuất</label>
                                        <input id="descEdit" name="brand_product_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả Nhà sản xuất hay nhà sản xuất." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Hình ảnh 870 x 200 px</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="brand_image" type="file" class="custom-file-input" id="customFile2" />
                                                      <label class="custom-file-label" for="customFile2">Chọn hình ảnh</label>
                                                  </div>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Hình ảnh hiện tại 870 x 200 px</label>
                                          <div>
                                          <img style="width: 100px; align-items: center;" id="imageEdit" src="#">
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="brand_product_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-brand_product" class="btn btn-warning">CẬP NHẬT</button>
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
