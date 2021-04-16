@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý danh mục sản phẩm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Danh mục sản phẩm</li>
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
                <h3 class="card-title">Danh sách danh mục sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên danh mục sản phẩm</th>
                                    <th>Thuộc danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Keywords SEO</th>
                                    <th>Hình ảnh đại diện</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_category_product as $key => $category)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($category->category_name,10) }}</td>
                                        <td>
                                          @if ($category->category_parent == 0)
                                            <span class="badge badge-success">Danh mục gốc</span>
                                          @else
                                            @foreach ($all_category_product as $key => $category_sub)
                                              @if ($category_sub->category_id == $category->category_parent)

                                                <span class="badge badge-danger">{{$category_sub->category_name}}</span>
                                          @else
                                              @endif
                                            @endforeach
                                          @endif
                                        </td>
                                        <td style="text-align: justify;">{{ cutTitle($category->category_desc,10)}}</td>
                                        <td>{{ $category->meta_keywords }}</td>
                                        <td><img src="public/uploads/images/product/{{ $category->category_image }}" height="50px" width="145px" /></td>
                                        <td>
                                            <?php
                                                if($category->category_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-category-product/'.$category->category_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-category-product/'.$category->category_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$category->category_id}}',
                                                    name: '{{$category->category_name}}',
                                                    desc: '{{$category->category_desc}}',
                                                    seo: '{{$category->meta_keywords}}',
                                                    status: '{{$category->category_status}}', 
                                                    image: '{{$category->category_image}}', 
                                                    parent: '{{$category->category_parent}}', 
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục sản phẩm này không?')" href="{{URL::to('/delete-category-product/'.$category->category_id)}}" class="active styling-edit" ui-toggle-class="">
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
            <form action="{{URL::to('/insert-category-product')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm mới danh mục sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của danh mục sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                              <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label>Tên danh mục sản phẩm</label>
                                          <input name="category_product_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục sản phẩm." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Nội dung mô tả danh mục sản phẩm</label>
                                          <input name="category_product_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục sản phẩm." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Từ khóa SEO danh mục sản phẩm</label>
                                          <input name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO danh mục sản phẩm." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="form-group">
                                              <label>Hình ảnh đại diện danh mục 870 x 200 px</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="category_product_image" type="file" class="custom-file-input" id="customFile1" required/>
                                                      <label class="custom-file-label" for="customFile1">Chọn hình ảnh</label>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Thuộc danh mục</label>
                                              <select name="category_parent" class="form-control is-warning">
                                                  <option value="0">----- Danh mục gốc -----</option>
                                                  @foreach ($all_category_product as $key => $val)
                                                    @if ($val->category_parent == 0)
                                                      <option value="{{ $val->category_id }}">{{ $val->category_name }}</option>
                                                    @endif
                                                    @foreach ($all_category_product as $key => $val2)
                                                      @if ($val2->category_parent == $val->category_id)
                                                      <option value="{{ $val2->category_id }}">----- {{ $val2->category_name }}</option>
                                                    @endif
                                                    @endforeach
                                                  @endforeach
                                                  
                                              </select>
                                         </div>
                                      </div>
	                                    <div class="col-sm-6">
	                                      <div class="form-group">
	                                        <label>Trạng thái</label>
	                                            <select name="category_product_status" class="form-control is-warning">
	                                                <option value="1">Hiển thị</option>
	                                                <option value="0">Không hiển thị</option>
	                                            </select>
	                                       </div>
                                      </div>
                                    </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-category-product" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = category => {
        console.log(category)
        const action = '{!! URL::to('/update-category-product') !!}/' + category.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("nameEdit").value = category.name;
        document.getElementById("descEdit").value = category.desc;
        document.getElementById("statusEdit").value = category.status;
        document.getElementById("seoEdit").value = category.seo;
        document.getElementById("parentEdit").value = category.parent;
        document.getElementById("imageEdit").src = 'public/uploads/images/product/' + category.image;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin danh mục sản phẩm</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của danh mục sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên danh mục sản phẩm</label>
                                        <input id="nameEdit" name="category_product_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục sản phẩm." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả danh mục sản phẩm</label>
                                        <input id="descEdit" name="category_product_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục sản phẩm." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Hình ảnh 870 x 200 px</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="category_product_image" type="file" class="custom-file-input" id="customFile2" />
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
                                          <label>Từ khóa SEO</label>
                                          <input id="seoEdit" name="meta_keywords" type="text" class="form-control is-warning" placeholder="Nhập từ khóa SEO." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="category_product_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                       <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Thuộc danh mục</label>
                                              <select id="parentEdit" name="category_parent" class="form-control is-warning">
                                                  <option value="0">----- Danh mục gốc -----</option>
                                                  @foreach ($all_category_product as $key => $val)
                                                    @if ($val->category_parent == 0)
                                                      <option value="{{ $val->category_id }}">{{ $val->category_name }}</option>
                                                    @endif
                                                    @foreach ($all_category_product as $key => $val2)
                                                      @if ($val2->category_parent == $val->category_id)
                                                      <option value="{{ $val2->category_id }}">----- {{ $val2->category_name }}</option>
                                                    @endif
                                                    @endforeach
                                                  @endforeach
                                                  
                                              </select>
                                         </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-category_product" class="btn btn-warning">CẬP NHẬT</button>
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
