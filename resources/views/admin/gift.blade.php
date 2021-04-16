@extends('admin_layout')
@section('admin_content')
<!-- Main content -->
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Quản lý quà tặng tri ân khách hàng</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Quản lý quà tặng tri ân khách hàng</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
        <div class="breadcrumb float-sm-right">
          <button data-toggle="modal" data-target="#modal-xl-addqtrian" ui-toggle-class="" type="submit" name="" class="btn btn-warning">Thêm mới</button>
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
                <h3 class="card-title">Danh sách quà tặng tri ân khách hàng</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Tên quà tri ân</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($allquatang as $key => $qt)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td style="text-align: left;">{{ cutTitle($qt->quatang_ten,10) }}</td>
                                        <td>{{ $qt->quatang_soluong }}</td>
                                        <td>{{ number_format($qt->quatang_gia).' VNĐ' }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modal-xl-updateqttrian" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$qt->quatang_id}}',
                                                    ten: '{{$qt->quatang_ten}}',
                                                    soluong: '{{$qt->quatang_soluong}}',
                                                    gia:'{{ $qt->quatang_gia }}',
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa quà tặng này không?')" href="{{URL::to('/delete-quatang/'.$qt->quatang_id)}}" class="active styling-edit" ui-toggle-class="">
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
<div class="modal fade" id="modal-xl-addqtrian">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-quatang')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm quà tặng tri ân khách hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của quà tặng tri ân khách hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-quatang')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên quà tặng tri ân khách hàng </label>
                                        <input name="quatang_ten" type="text" class="form-control is-warning" placeholder="Nhập tên của quà tặng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label> Số lượng quà tặng tri ân khách hàng</label>
                                        <input name="quatang_soluong" type="text" class="form-control is-warning" placeholder="Nhập số lượng quà tặng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Giá quà tặng tri ân khách hàng</label>
                                        <input name="quatang_gia" type="text" class="form-control is-warning" placeholder="Nhập đơn giá của quà tặng." required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-qt" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = qt => {
        console.log(qt)
        const action = '{!! URL::to('/update-quatang') !!}/' + qt.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("tenEdit").value = qt.ten;
        document.getElementById("soluongEdit").value = qt.soluong;
        document.getElementById("giaEdit").value = qt.gia;
    }
</script>
<div class="modal fade" id="modal-xl-updateqttrian">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin quà tặng tri ân khách hàng</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của quà tặng tri ân khách hàng</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="formEdit" action="" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Tên quà tặng tri ân khách hàng </label>
                                        <input id="tenEdit" name="quatang_ten" type="text" class="form-control is-warning" placeholder="Nhập tên của quà tặng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label> Số lượng quà tặng tri ân khách hàng</label>
                                        <input id="soluongEdit" name="quatang_soluong" type="text" class="form-control is-warning" placeholder="Nhập số lượng quà tặng." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Giá quà tặng tri ân khách hàng</label>
                                        <input id="giaEdit" name="quatang_gia" type="text" class="form-control is-warning" placeholder="Nhập đơn giá của quà tặng." required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-qt" class="btn btn-warning">CẬP NHẬT</button>
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
