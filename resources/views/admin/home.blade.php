@extends('admin_layout')
@section('admin_content')

<div class="col-12">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tổng quan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Tổng quan</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$admin_count}}</h3>

                    <p>Cộng tác viên</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-secret "></i>
                </div>
                @if (Session::get('admin_type')==1)
                <a href="{{URL::to('/staff')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$customer_count}}</h3>
                    <p>Khách hàng</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                @if (Session::get('admin_type')==1)
                <a href="{{URL::to('/customer')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$order_count}}</h3>
                    <p>Đơn hàng</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                @if (Session::get('admin_type')==1)
                <a href="{{URL::to('/manage-order')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$product_count}}</h3>
                    <p>Sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file"></i>
                </div>
                @if (Session::get('admin_type')==1)
                <a href="{{URL::to('/manage-product')}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                @endif
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="container-fluid">
        <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">TOP</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                    {{csrf_field()}}
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputFile">Đơn hàng</label>
                            
                                <div class="card card-danger">
                                  <div class="card-header">
                                    <h3 class="card-title">Đơn hàng mới</h3>
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body table-responsive p-0" style="height: 300px;">
                                    <table class="table table-head-fixed text-nowrap">
                                      <thead>
                                        <tr style="text-align: center;">
                                          <th>STT</th>
                                          <th>Mã đơn hàng</th>
                                          <th>Ngày đặt hàng</th>
                                          <th>Chi tiết</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php 
                                            $i = 0;
                                        @endphp
                                        @foreach ($order_dashboard as $key => $ord)
                                        @php 
                                            $i++;
                                        @endphp                                           
                                        <tr style="text-align: center;">
                                          <td>{{ $i }}</td>
                                          <td>{{ $ord->order_code}}</td>
                                          <td>{{ date('d/m/Y h:i:s', strtotime($ord->created_at)) }}</td>
                                          <td>
                                               <?php
                                                if($ord->order_status==1){
                                            ?>
                                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}"><span class="badge badge-warning">Chờ xác nhận</span></a>
                                            <?php
                                                }else if ($ord->order_status==2){
                                            ?>
                                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}"><span class="badge badge-secondary"> Đã xác nhận</span></a>
                                            <?php
                                                }else if ($ord->order_status==3){
                                            ?>
                                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}"><span class="badge badge-info"> Đang vận chuyển</span></a>
                                                <?php
                                                }else if ($ord->order_status==4){
                                            ?>
                                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}"><span class="badge badge-success"> Đã giao hàng</span></a>
                                            <?php
                                                }else if ($ord->order_status==5){
                                            ?>
                                                <a href="{{URL::to('/view-order/'.$ord->order_code)}}"><span class="badge badge-danger"> Đã hủy</span></a>
                                            <?php
                                                }
                                            ?>
                                          </td>
                                        </tr>
                                        @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                  <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                              
                        </div>
                    </div>
                    <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputFile">Kho</label>
                                
                                    <div class="card card-info">
                                      <div class="card-header">
                                        <h3 class="card-title">Sản phẩm gần hết</h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-striped">
                                          <thead>
                                            <tr style="text-align: center">
                                              <th>STT</th>
                                              <th>Tên sản phẩm</th>
                                              <th>Chi tiết</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php 
                                                $i = 0;
                                            @endphp
                                            @foreach ($product_dashboard as $key => $prod)
                                            @php 
                                                
                                                if ($prod->product_quantity - $prod->product_sold <5){
                                                $i++;
                                            @endphp 
                                            <tr style="text-align: center">
                                            <td>{{ $i }}</td>
                                              <td  style="text-align: justify;">{{ cutTitle($prod->product_name,10) }}</td>
                                              <td><a @if (Session::get('admin_type')==1) href="{{URL::to('/manage-product')}}" @endif><span class="badge badge-danger">Còn {{ $prod->product_quantity - $prod->product_sold }} SP</span></a></td>
                                            </tr>
                                            @php
                                            }
                                            @endphp
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                 
                            </div>
                       
                    </div>
                    <div class="col-sm-4">
                        
                            <div class="form-group">
                                <label for="exampleInputFile">Góp ý</label>
                               
                                    <div class="card card-success">
                                      <div class="card-header">
                                        <h3 class="card-title">Liên hệ mới từ khách hàng</h3>
                                      </div>
                                      <!-- /.card-header -->
                                      <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-striped">
                                          <thead>
                                            <tr style="text-align: center;">
                                              <th>STT</th>
                                              <th>Nội dung</th>
                                              <th>Chi tiết</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php 
                                                $i = 0;
                                            @endphp
                                            @foreach ($contact_dashboard as $key => $con)
                                            @php 
                                                $i++;
                                            @endphp 
                                            <tr style="text-align: center;">
                                              <td>{{ $i }}</td>
                                              <td style="text-align: justify;">{{ cutTitle($con->contact_content,10)}}</td>
                                              <td><a @if (Session::get('admin_type')==1) href="{{URL::to('/manage-contact')}}" @endif><span class="fa fa-eye"></span></a></td>
                                            </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                               
                            </div>
                        </div>
                   
                </div>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    
</div>

@endsection


