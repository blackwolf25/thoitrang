@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý tài liệu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Tài liệu</li>
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
                <h3 class="card-title">Danh mục tài liệu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 200px;">
                 <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="text-align: center;">
                      <th>STT</th>
                      <th>Danh mục tài liệu</th>
                      <th>Mô tả danh mục tài liệu</th>
                      <th>Slug</th>
                      <th>Hình đại diện</th>
                      <th>Trạng thái</th>
                      <th>Sửa</th>
                      <th>Xóa</th>
                    </tr>
                  </thead>
                        <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_category_document as $key => $category)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($category->category_name,10) }}</td>
                                        <td style="text-align: justify;">{{ cutTitle($category->category_desc,10)}}</td>
                                        <td style="text-align: justify;">{{ cutTitle($category->category_slug,10)}}</td>
                                        <td><img src="public/uploads/images/document/{{ $category->category_image }}" height="50px" width="145px" /></td>
                                        <td>
                                            <?php
                                                if($category->category_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-category-document/'.$category->category_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-category-document/'.$category->category_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update-cate-document" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    idcate: '{{$category->category_id}}',
                                                    namecate: '{{$category->category_name}}',
                                                    desccate: '{{$category->category_desc}}',
                                                    statuscate: '{{$category->category_status}}',
                                                    imagecate: '{{$category->category_image}}', 
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục tài liệu này không?')" href="{{URL::to('/delete-category-document/'.$category->category_id)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
                
              </div>
              <br>
              <div style="padding-left: 20px">
              <button data-toggle="modal" data-target="#modal-xl-add-cate-document" ui-toggle-class="" type="submit" name="add_category_document" class="btn btn-warning">Thêm mới danh mục tài liệu</button>
         </div>
         <br>
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
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách tài liệu</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr style="text-align: center;">
                    <th>STT</th>
                    <th>Tiêu đề tài liệu</th>
                    <th>Nội dung tóm tắt của tài liệu</th>
                    <th>Danh mục tài liệu</th>
                    <th>Ngày ban hành</th>
                    <th>Trạng thái</th>
                    <th>Tải</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_document as $key => $document)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($document->document_name,10) }}</td>
                                        <td style="text-align: justify;">{!! cutTitle($document->document_desc,10)!!}</td>
                                        <td style="text-align: justify;">{{ $document->category_name }}</td>
                                        <td style="text-align: center;">{{ $document->document_date }}</td>
                                        <td>
                                            <?php
                                                if($document->document_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-document/'.$document->document_id)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-document/'.$document->document_id)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td><a href="public/uploads/files/{{$document->document_file}}"><i class="fa fa-download "></i></a></td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update-document" class="active styling-edit" ui-toggle-class=""
                                          data-id="{{ $document->document_id }}"
                                          data-name="{{ $document->document_name }}"
                                          data-desc="{{ $document->document_desc }}"
                                          data-image="{{ $document->document_image }}"
                                          data-file="{{ $document->document_file }}"
                                          data-date="{{ $document->document_date }}"
                                          data-category="{{ $document->category_id }}"
                                          data-status="{{ $document->document_status }}"
                                    onclick="renderPRO(this)"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa tài liệu này không?')" href="{{URL::to('/delete-document/'.$document->document_id)}}" class="active styling-edit" ui-toggle-class="">
                                                <i class="fa fa-trash text-danger text"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                </table>
                <div>
              <button data-toggle="modal" data-target="#modal-xl-add-document" ui-toggle-class="" type="submit" name="add_document" class="btn btn-warning">Thêm mới tài liệu</button>
          </div>
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

{{-- modal danh muc tai lieu --}}
    <div class="modal fade" id="modal-xl-add-cate-document">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form action="{{URL::to('/insert-category-document')}}" role="form" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-header">
                      <h4 class="modal-title">Thêm mới danh mục tài liệu</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-12">
                          <!-- general form elements disabled -->
                          <div class="card card-warning">
                              <div class="card-header">
                                  <h3 class="card-title">Thông tin của danh mục tài liệu</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <form action="" role="form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label>Tên danh mục tài liệu</label>
                                          <input name="category_document_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục tài liệu." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Nội dung mô tả danh mục tài liệu</label>
                                          <input name="category_document_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục tài liệu." required>
                                        </div>
                                      </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Hình ảnh đại diện danh mục</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="category_document_image" type="file" class="custom-file-input" id="customFileImage" required/>
                                                    <label class="custom-file-label" for="customFileImage">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                                <select name="category_document_status" class="form-control is-warning">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Không hiển thị</option>
                                                </select>
                                          </div>
                                    </div>   
                                      </div>
                                  </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                      <button type="submit" name="insert-category-document" class="btn btn-warning">THÊM MỚI</button>
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
        const action = '{!! URL::to('/update-category-document') !!}/' + category.idcate;
        document.getElementById("formcatedocumentEdit").action = action;
        document.getElementById("namecatedocumentEdit").value = category.namecate;
        document.getElementById("desccatedocumentEdit").value = category.desccate;
        document.getElementById("statuscatedocumentEdit").value = category.statuscate;
        document.getElementById("imagecatedocumentEdit").src = 'public/uploads/images/document/' + category.imagecate;
    }
</script>
<div class="modal fade" id="modal-xl-update-cate-document">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formcatedocumentEdit" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin danh mục tài liệu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của danh mục tài liệu</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" role="form" method="POST" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên danh mục tài liệu</label>
                                        <input id="namecatedocumentEdit" name="category_document_name" type="text" class="form-control is-warning" placeholder="Nhập tên của danh mục tài liệu." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả danh mục tài liệu</label>
                                        <input id="desccatedocumentEdit" name="category_document_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả danh mục tài liệu." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-form-label" for="inputWarning">Hình ảnh đại diện danh mục tài liệu hiện tại</label>
                                      <div>
                                        <img style="width: 100px; align-items: center;" id="imagecatedocumentEdit" src="#">
                                      </div>
                                  </div>
                                  </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Cập nhật lại hình ảnh danh mục</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="category_document_image" type="file" class="custom-file-input" id="customFileFile" />
                                                    <label class="custom-file-label" for="customFileFile">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-sm-12">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statuscatedocumentEdit" name="category_document_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-category-document" class="btn btn-warning">CẬP NHẬT</button>
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

{{-- modal tai lieu --}}

      <div class="modal fade" id="modal-xl-add-document">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <form action="{{URL::to('/insert-document')}}" role="form" method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="modal-header">
                      <h4 class="modal-title">Thêm mới danh mục tài liệu</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-12">
                          <!-- general form elements disabled -->
                          <div class="card card-warning">
                              <div class="card-header">
                                  <h3 class="card-title">Thông tin của tài liệu</h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <form action="" role="form" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                  <div class="row">
                                      <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                          <label>Tiêu đề tài liệu</label>
                                          <input name="document_name" type="text" class="form-control is-warning" placeholder="Nhập tiêu đề của tài liệu." required>
                                        </div>
                                      </div>
                                      <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung tóm tắt tài liệu</label>
                                        <textarea style="resize: none" rows="8" name="document_desc" type="text" class="form-control is-warning" id="ckeditordesc"  placeholder="Nhập nội dung tóm tắt tài liệu." required></textarea>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Ngày ban hành tài liệu</label>
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                              <input name="document_date"  placeholder="Nhập tháng/ ngày/ năm phát hành của tài liệu." type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                              <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Hình ảnh đại diện tài liệu</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="document_image" type="file" class="custom-file-input" id="customFile1" />
                                                    <label class="custom-file-label" for="customFile1">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Danh mục tài liệu</label>
                                          <select name="document_cate" class="form-control is-warning">
                                                @foreach($all_category_document as $key => $catedocument)
                                                <option value="{{$catedocument->category_id}}">{{$catedocument->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Tài liệu</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="document_file" type="file" class="custom-file-input" id="customFile2" required="" />
                                                    <label class="custom-file-label" for="customFile2">Chọn tệp tài liệu cần tải lên</label>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                                <select name="document_status" class="form-control is-warning">
                                                    <option value="1">Hiển thị</option>
                                                    <option value="0">Không hiển thị</option>
                                                </select>
                                          </div>
                                    </div>   
                                  </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                      <button type="submit" name="insert-document" class="btn btn-warning">THÊM MỚI</button>
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
    const renderPRO = doc => {
        console.log(doc.dataset)
        const action = '{!! URL::to('/update-document') !!}/' + doc.dataset.id;
        document.getElementById("formdocumentEdit").action = action;
        document.getElementById("namedocumentEdit").value = doc.dataset.name;
        CKEDITOR.instances.ckeditordescedit.setData(doc.dataset.desc);
        document.getElementById("statusdocumentEdit").value = doc.dataset.status;
        document.getElementById("datedocumentEdit").value = doc.dataset.date;
        document.getElementById("imagedocumentEdit").src = 'public/uploads/images/document/' + doc.dataset.image;
        document.getElementById("filedocumentEdit").src = 'public/uploads/files/' + doc.dataset.file;
        document.getElementById("categorydocumentEdit").value = doc.dataset.category;
    }
</script>
<div class="modal fade" id="modal-xl-update-document">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formdocumentEdit" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật tài liệu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của tài liệu</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label  class="col-form-label" for="inputWarning">Tiêu đề tài liệu</label>
                                        <input id="namedocumentEdit" name="document_name" type="text" class="form-control is-warning" placeholder="Nhập tiêu đề của tài liệu." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label  class="col-form-label" for="inputWarning">Nội dung tóm tắt tài liệu</label>
                                        <textarea style="resize: none" rows="8" name="document_desc"  class="form-control is-warning" id="ckeditordescedit" placeholder="Nhập nội dung tóm tắt tài liệu..." /></textarea>
                                      </div>
                                    </div>
                                  <div class="col-sm-4">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label  class="col-form-label" for="inputWarning">Danh mục tài liệu</label>
                                            <select id="categorydocumentEdit" name="document_cate" class="form-control is-warning">
                                                @foreach($all_category_document as $key => $cate)
                                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                  <div class="col-sm-4">
                                      <div class="form-group">
                                        <label  class="col-form-label" for="inputWarning">Ngày ban hành tài liệu</label>
                                          <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                              <input id="datedocumentEdit" name="document_date"  placeholder="Nhập tháng/ ngày/ năm phát hành của tài liệu." type="text" class="form-control datetimepicker-input" data-target="#reservationdate2"/>
                                              <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                          <label  class="col-form-label" for="inputWarning">Trạng thái</label>
                                              <select id="statusdocumentEdit" name="document_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                    </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-form-label" for="inputWarning">Hình ảnh đại diện tài liệu hiện tại</label>
                                      <div>
                                        <img style="width: 100px; align-items: center;" id="imagedocumentEdit" src="#">
                                      </div>
                                    </div>
                                  </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label  class="col-form-label" for="inputWarning">Cập nhật lại hình ảnh đại diện tài liệu </label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="document_image" type="file" class="custom-file-input" id="customFileImage3" />
                                                    <label class="custom-file-label" for="customFileImage3">Chọn hình ảnh</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                      <label class="col-form-label" for="inputWarning">Tài liệu hiện tại</label>
                                      <input id="filedocumentEdit" type="text" class="form-control is-warning"/>
                                    </div>
                                  </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label  class="col-form-label" for="inputWarning">Cập nhật lại tệp tài liệu</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="document_file" type="file" class="custom-file-input" id="customFileFile1" />
                                                    <label class="custom-file-label" for="customFileFile1">Chọn lại tệp tài liệu</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-document" class="btn btn-warning">CẬP NHẬT</button>
                                </div>
                                </div>
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
