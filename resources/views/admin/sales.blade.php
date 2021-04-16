@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Doanh số</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Doanh số</li>
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
		        <div class="col-lg-4 col-4">
		            <!-- small box -->
		            <div class="small-box bg-info">
		                <div class="inner">
		                    <h3>50.000 <sup>VNĐ</sup> </h3>

		                    <p>Tổng tiền hàng hóa toàn kho</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fas fa-upload"></i>
		                </div>
		            </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-4 col-4">
		            <!-- small box -->
		            <div class="small-box bg-secondary">
		                <div class="inner">
		                    <h3>{{-- {{number_format($all_order * 10000)}} --}} <sup>VNĐ</sup> </h3>
		                    <p>Tổng tiền hàng hóa đã bán</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-sync"></i>
		                </div>
		            </div>
		        </div>
		        <!-- ./col -->
		        <div class="col-lg-4 col-4">
		            <!-- small box -->
		            <div class="small-box bg-success">
		                <div class="inner">
		                    <h3>50.000 <sup>VNĐ</sup> </h3>
		                    <p>Tổng tiền hàng hóa thực tế</p>
		                </div>
		                <div class="icon">
		                    <i class="icon fa fa-download"></i>
		                </div>
		            </div>
		        </div>

		    </div>
        <hr>
		    <div class="row">
		        <div class="container-fluid">
		            <div class="row">
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box">
		              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-credit-card"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Hôm nay</span>
		                <span class="info-box-number">10
		                  <small>VNĐ</small>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-credit-card"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Tuần này</span>
		                <span class="info-box-number">41,410
		                <small>VNĐ</small>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->

		          <!-- fix for small devices only -->
		          <div class="clearfix hidden-md-up"></div>

		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-credit-card"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Tháng này</span>
		                <span class="info-box-number">760
		                <small>VNĐ</small>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		          <div class="col-12 col-sm-6 col-md-3">
		            <div class="info-box mb-3">
		              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-credit-card"></i></span>

		              <div class="info-box-content">
		                <span class="info-box-text">Năm này</span>
		                <span class="info-box-number">2,000
		                <small>VNĐ</small>
		                </span>
		              </div>
		              <!-- /.info-box-content -->
		            </div>
		            <!-- /.info-box -->
		          </div>
		          <!-- /.col -->
		        </div>
		        <!-- /.row -->

		        </div>
		    </div>
        <hr>


    	</div>
    </section>




@endsection
