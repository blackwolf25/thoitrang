@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý video</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">video</li>
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
                <h3 class="card-title">Danh sách video</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên video</th>
                                    <th>Mô tả</th>
                                    <th>Link</th>
                                    <th>Hình ảnh đại diện</th>
                                    <th>Xem nhanh</th>
                                    <th>Trạng thái</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_video as $key => $video)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($video->video_title,10) }}</td>
                                        <td style="text-align: justify;">{{ cutTitle($video->video_desc,10) }}</td>
                                        <td>{{ cutTitle($video->video_link,15) }}</td>
                                        <td><img src="public/uploads/images/video/{{$video->video_image}}" width="100px"/></td>
                                        <td><iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{$video->video_link}}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                 
                                        </td>
                                        <td>
                                            <?php
                                                if($video->video_status==1){
                                            ?>
                                                <a href="{{URL::to('/unactive-video/'.$video->video_slug)}}"><span class=" fa fa-eye"></span></a>
                                            <?php
                                                }else{
                                            ?>
                                                <a href="{{URL::to('/active-video/'.$video->video_slug)}}"><span style="color: orange" class="fa fa-eye-slash"></span></a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$video->video_id}}',
                                                    title: '{{$video->video_title}}',
                                                    desc: '{{$video->video_desc}}',
                                                    status: '{{$video->video_status}}',
                                                    link:'{{ $video->video_link }}',
                                                    image:'{{ $video->video_image }}',
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa video này không?')" href="{{URL::to('/delete-video/'.$video->video_id)}}" class="active styling-edit" ui-toggle-class="">
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
            <form action="{{URL::to('/insert-video')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của video</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-video')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên video</label>
                                        <input name="video_title" type="text" class="form-control is-warning" placeholder="Nhập tên của video." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả video</label>
                                        <input name="video_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả video." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Link</label>
                                        <input name="video_link" type="text" class="form-control is-warning" placeholder="Nhập đường dẫn của video." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Hình ảnh đại diện video</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="video_image" type="file" class="custom-file-input" id="customFileImage" required/>
                                                      <label class="custom-file-label" for="customFileImage">Chọn hình ảnh</label>
                                                  </div>
                                              </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select name="video_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-video" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = video => {
        console.log(video)
        const action = '{!! URL::to('/update-video') !!}/' + video.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("titleEdit").value = video.title;
        document.getElementById("descEdit").value = video.desc;
        document.getElementById("statusEdit").value = video.status;
        document.getElementById("linkEdit").value = video.link;
        document.getElementById("imageEdit").src = 'public/uploads/images/video/' + video.image;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của video</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-video')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên video</label>
                                        <input id="titleEdit" name="video_title" type="text" class="form-control is-warning" placeholder="Nhập tên của video." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung mô tả video</label>
                                        <input id="descEdit" name="video_desc" type="text" class="form-control is-warning" placeholder="Nhập nội dung mô tả video." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Link</label>
                                        <input id="linkEdit" name="video_link" type="text" class="form-control is-warning" placeholder="Nhập link.">
                                      </div>
                                    </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label>Trạng thái</label>
                                              <select id="statusEdit" name="video_status" class="form-control is-warning">
                                                  <option value="1">Hiển thị</option>
                                                  <option value="0">Không hiển thị</option>
                                              </select>
                                        </div>
                                      </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <label for="exampleInputFile">Cập nhật lại hình ảnh</label>
                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="video_image" type="file" class="custom-file-input" id="customFile" />
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
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-video" class="btn btn-warning">CẬP NHẬT</button>
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
