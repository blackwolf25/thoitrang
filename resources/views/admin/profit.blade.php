@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Doanh thu - Lợi nhuận</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Doanh thu - Lợi nhuận</li>
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
		        <div class="col-lg-3 col-3">
		            <!-- small box -->
		            <div class="small-box bg-info">
		                <div class="inner">
		                    <h3>{{number_format($quatang)}} <sup>VNĐ</sup> </h3>

		                    <p>Tổng chi phí cho quà tặng</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-3">
		            <!-- small box -->
		            <div class="small-box bg-secondary">
		                <div class="inner">
		                    <h3>{{number_format($von)}} <sup>VNĐ</sup> </h3>
		                    <p>Tổng chi phí vốn</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-3 col-3">
		            <!-- small box -->
		            <div class="small-box bg-success">
		                <div class="inner">
		                    <h3>{{number_format($vanchuyen)}} <sup>VNĐ</sup> </h3>
		                    <p>Tổng chi phí vận chuyển</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		        <div class="col-lg-3 col-3">
		            <!-- small box -->
		            <div class="small-box bg-danger">
		                <div class="inner">
		                    <h3>{{number_format($chiphi)}} <sup>VNĐ</sup> </h3>
		                    <p>Tổng chi phí hệ thống</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		    </div>
        <hr>
            <div class="row">
                <div class="col-lg-6 col-6">
		            <!-- small box -->
		            <div class="small-box bg-default">
		                <div class="inner">
		                    <h3>{{number_format($doanhthu)}} <sup>VNĐ</sup> </h3>

		                    <p>Tổng doanh thu</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		        <div class="col-lg-6 col-6">
		            <!-- small box -->
		            <div class="small-box bg-warning">
		                <div class="inner">
		                    <h3>{{number_format($doanhthu-$von-$vanchuyen-$chiphi-$quatang)}} <sup>VNĐ</sup> </h3>

		                    <p>Tổng lợi nhuận</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-university"></i>
		                </div>
		            </div>
		        </div>
		        
		        <!-- ./col -->
		        
		    </div>
        <div>
        <button data-toggle="modal" data-target="#modal-xl-add" ui-toggle-class="" type="submit" name="add_customer_backend" class="btn btn-primary">Thêm mới</button>
        </div>
        <br>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách Chi phí sau lợi  nhuận</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                 <thead style="text-align: center;">
                                  <tr>
                                    <th style="width: 10px;">STT</th>
                                    <th>Ngày chi phí</th>
                                    <th>Nội dung chi phí</th>
                                    <th>Chi phí</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>                            
                                  </tr>
                              </thead>
                              <tbody tyle="text-align: center;">
                                @php 
                                    $i = 0;
                                @endphp
                                @foreach($all_profit as $key => $profit)
                                    @php 
                                        $i++;
                                    @endphp
                                    <tr style="text-align: center; align-self: center;">
                                        <td>{{$i}}</td>
                                        <td>{{ date('d-m-Y', strtotime($profit->profit_date)) }}</td>
                                        <td style="text-align: justify;">{{ cutTitle($profit->profit_content,20) }}</td>
                                        <td>{{ $profit->profit_money }}</td>
                                        <td>
                                          <a href="#" data-toggle="modal" data-target="#modal-xl-update" class="active styling-edit" ui-toggle-class=""
                                                onclick="renderDOM({ 
                                                    id: '{{$profit->profit_id}}',
                                                    content: '{{$profit->profit_content}}',
                                                    date: '{{$profit->profit_date}}',
                                                    money: '{{$profit->profit_money}}',
                                                })"><i class="fa fa-edit text-success text-active"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="return confirm('Bạn có chắc là muốn xóa chi phí sau lợi nhuận này không?')" href="{{URL::to('/delete-profit/'.$profit->profit_id)}}" class="active styling-edit" ui-toggle-class="">
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
    </section>
    
<div class="modal fade" id="modal-xl-add">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{URL::to('/insert-profit')}}" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Thêm profit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của chi phí sau lợi nhuận</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-profit')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Thời điểm chi phí</label>
                                          <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                                              <input name="profit_date"  placeholder="Nhập thời điểm dùng chi phí sau lợi nhuận." type="text" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
                                              <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>

                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung của việc chi phí</label>
                                        <input name="profit_content" type="text" class="form-control is-warning" placeholder="Nhập nội dung chi tiết của việc chi phí sau lợi nhuận." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Số tiền cần để chi phí sau lợi nhuận</label>
                                         <input name="profit_money" type="text" class="form-control is-warning" placeholder="Nhập chính xác số tiền sử dụng cho chi phí sau lợi nhuận này." required>
                                      </div>
                                    </div>
                                      
                                    
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="insert-profit" class="btn btn-warning">THÊM MỚI</button>
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
    const renderDOM = profit => {
        console.log(profit)
        const action = '{!! URL::to('/update-profit') !!}/' + profit.id;
        document.getElementById("formEdit").action = action;
        document.getElementById("dateEdit").value = profit.date;
        document.getElementById("contentEdit").value = profit.content;
        document.getElementById("moneyEdit").value = profit.money;
    }
</script>
<div class="modal fade" id="modal-xl-update">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="" id="formEdit" role="form" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4 class="modal-title">Cập nhật thông tin chi phí sau lợi nhuận</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin của chi phí sau lợi nhuận</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{URL::to('/insert-profit')}}" role="form" method="post" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Thời điểm chi phí</label>
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input id="dateEdit" name="profit_date"  placeholder="Nhập thời điểm dùng chi phí sau lợi nhuận." type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <div class="form-group">
                                        <label>Nội dung chi tiết của việc sử dụng chi phí sau lợi nhuận</label>
                                        <input id="contentEdit" name="profit_content" type="text" class="form-control is-warning" placeholder="Nhập nội dung chi tiết của việc sử dụng chi phí sau lợi nhuận." required>
                                      </div>
                                    </div>
                                    <div class="col-sm-12">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Số tiền cần để chi phí sau lợi nhuận</label>
                                        <input id="moneyEdit" name="profit_money" type="text" class="form-control is-warning" placeholder="Nhập chính xác số tiền sử dụng cho chi phí sau lợi nhuận này." required>
                                      </div>
                                    </div>
                                    
                                      
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">HỦY</button>
                                    <button type="submit" name="update-profit" class="btn btn-warning">CẬP NHẬT</button>
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
