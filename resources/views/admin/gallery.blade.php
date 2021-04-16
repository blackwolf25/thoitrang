@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý thư viện ảnh của sản phẩm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item"><a href="{{URL::to('/manage-product')}}">Sản phẩm</a></li>
              <li class="breadcrumb-item active">Thư viện ảnh của sản phẩm</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        <div class="breadcrumb float-sm-right">
          <a href="{{URL::to('/manage-product')}}" type="submit" class="btn btn-warning">Trở  về danh sách sản phẩm</a>
        </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thư viện ảnh của sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                  <div class="col-md-3">
                    
                  </div>
                  <br>
                  <div class="col-md-6">
                                        <div class="form-group">
                                          <br>
                                          <label for="exampleInputFile">Thêm hình ảnh vào thư viện của sản phẩm </label>

                                              <div class="input-group">
                                                  <div class="custom-file">
                                                      <input name="file[]" accept="image/*" multiple type="file" class="custom-file-input" id="file " required>
                                                      <label class="custom-file-label" for="file">Chọn tối đa 5 hình ảnh</label>
                                                  </div>
                                                  <input type="submit" name="upload" value="Tải ảnh" class="btn btn-success">
                                              </div>
                                              <span id="error_gallery"></span>
                                        </div>

                  </div>
                  <div class="col-md-3">
                    
                  </div>
                </div>
              </form>
              <div class="card-body">

                <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
                <form>
                  @csrf
                <div id="gallery_load">
                  
                  
                </div>
                </form>
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



@endsection
