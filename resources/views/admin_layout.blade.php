<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>QUẢN LÝ HỆ THỐNG thoitrang</title>
  
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('public/uploads/images/website/uiuy.png')}}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <!-- Toast -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/toastr.min.css')}}">


  <link rel="stylesheet" href="{{asset('public/backend/dist/css/formValidation.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/bootstrap-tagsinput.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/morris.css')}}">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="dropdown user user-menu">
        <a href="{{URL::to('/dashboard')}}" class="dropdown-toggle" data-toggle="dropdown">
              <?php $avatar = Session::get('admin_avatar'); ?>
              <img width="50" height="50" src="{{asset('public/uploads/images/user/'.$avatar)}}" class="user-image" alt="avatar">
              <span class="hidden-xs">
                <?php
                $name = Session::get('admin_name');
                if ($name) {
                    echo $name;
                }
                ?>
                </span>
        </a>
        <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img width="50" height="50" src="{{asset('public/uploads/images/user/'.$avatar)}}" class="img-circle" alt="avatar">
          <p>
                  <?php
                  $name = Session::get('admin_name');
                  if ($name) {
                      echo $name;
                  }
                  ?> - <?php
                   $position = Session::get('admin_position');
                   if ($position) {
                       echo $position;
                   }
                   ?>
                  <small>Tham gia kể từ <?php
                  $created_day = date('d/m/Y', strtotime(Session::get('admin_created')));
                  if ($created_day) {
                      echo $created_day;
                  }
                  ?></small>
          </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer" style="text-align: center;">
                <div class="pull-left">
                  <a href="{{URL::to('/user-infor')}}">Thông tin tài khoản</a>
                </div>
                <div class="pull-right">
                  <a href="{{URL::to('/admin-logout')}}">Đăng xuất</a>
                </div>
              </li>
            </ul>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('/dashboard')}}" class="brand-link">
      <img src="{{asset('public/uploads/images/website/uiuy.png')}}" alt="logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span style="color: white" class="brand-text font-weight-light"><strong>thoitrang</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img style="width: 30px; height: 30px" src="{{asset('public/uploads/images/user/'.$avatar)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style="color: yellow" href="{{URL::to('/dashboard')}}" class="d-block"><strong><?php
          $name = Session::get('admin_name');
          if ($name) {
              echo $name;
          }
          ?></strong></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          </li>
          <li class="nav-item" >
            <a style="color: white" href="{{URL::to('/dashboard')}}" class="nav-link @if (\Request::is('dashboard')) active @endif">
              <i  class="nav-icon fas fa-tachometer-alt"></i>
              <p><strong>TRANG CHỦ</strong></p>
            </a>
          </li>
          @if (Session::get('admin_type')==1)

          
          <li class="nav-item">
            <a href="{{URL::to('/manage-slider')}}" class="nav-link @if (\Request::is('manage-slider')) active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>Baner</p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="{{URL::to('/manage-banner')}}" class="nav-link @if (\Request::is('manage-banner')) active @endif">
              <i class="nav-icon fas fa-band-aid"></i>
              <p>Banner</p>
            </a>
          </li>
          -->
          <!--<li class="nav-item">
            <a href="{{URL::to('/manage-video')}}" class="nav-link @if (\Request::is('manage-video')) active @endif">
              <i class="nav-icon fas fa-photo-video"></i>
              <p>Video</p>
            </a>
          </li>
          -->
          <li class="nav-item">
            <a href="{{URL::to('/manage-post')}}" class="nav-link @if (\Request::is('manage-post')) active @endif">
              <i class="nav-icon fas fa-pencil-ruler"></i>
              <p>Bài viết</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/manage-contact')}}" class="nav-link  @if (\Request::is('manage-contact')) active @endif">
              <i class="nav-icon fa fa-cog"></i>
              <p>Liên hệ</p>
            </a>
          </li>
          <!--<li class="nav-item">
            <a href="{{URL::to('/manage-document')}}" class="nav-link  @if (\Request::is('manage-document')) active @endif">
              <i class="nav-icon fa fa-file"></i>
              <p>Tài liệu</p>
            </a>
          </li>
          -->
          <li class="nav-item">
            <a href="{{URL::to('/manage-product')}}" class="nav-link @if (\Request::is('manage-product')) active @endif">
              <i class="nav-icon fas fa-industry"></i>
              <p>Sản phẩm</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/manage-brand-product')}}" class="nav-link @if (\Request::is('manage-brand-product')) active @endif">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>Nhà sản xuất</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/manage-category-product')}}" class="nav-link  @if (\Request::is('manage-category-product')) active @endif">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          @endif
          
         
          <li class="nav-item">
            <a href="{{URL::to('/manage-order')}}" class="nav-link @if (\Request::is('manage-order')) active @endif">
              <i class="nav-icon fas fa-th-list"></i>
              <p>Đơn hàng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/coupon')}}" class="nav-link @if (\Request::is('coupon')) active @endif">
              <i class="nav-icon fas fa-ad"></i>
              <p>Khuyến mãi</p>
            </a>
          </li>
         <!-- <li class="nav-item">
            <a href="{{URL::to('/delivery')}}" class="nav-link @if (\Request::is('delivery')) active @endif">
              <i class="nav-icon fas fa-truck"></i>
              <p>Cước vận chuyển</p>
            </a>
          </li>
          -->
          <li class="nav-item">
            <a href="{{URL::to('/qua-tang-tri-an')}}" class="nav-link @if (\Request::is('qua-tang-tri-an')) active @endif">
                <i class="fa fa-gift nav-icon"></i>
                <p>Quà tặng tri ân</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{URL::to('/profit')}}" class="nav-link @if (\Request::is('profit')) active @endif">
                <i class="fas fa-money-bill-alt nav-icon"></i>
                <p>Doanh thu - Lợi nhuận</p>
            </a>
          </li>
          @if (Session::get('admin_type')==1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>QUẢN TRỊ TÀI KHOẢN
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{URL::to('/customer')}}" class="nav-link @if (\Request::is('customer')) active @endif">
                  <i class="fas fa-people-carry nav-icon"></i>
                  <p>Khách hàng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/staff')}}" class="nav-link @if (\Request::is('staff')) active @endif">
                  <i class="fas fa-people-arrows nav-icon"></i>
                  <p>Cộng tác viên</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{URL::to('/manager')}}" class="nav-link @if (\Request::is('manager')) active @endif">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Quản trị viên</p>
                </a>
              </li>
            </ul>
          </li>
          
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <div class="content-wrapper">
    
    <br>
    <!-- Main content -->
    <section class="content">
        <div class="card">
          <br>
                @yield('admin_content')
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Bản quyền thuộc về <a href="{{url('trang-chu')}}">thoitrang</a>.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Phiên bản</b> 2021
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('public/backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('public/backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('public/backend/plugins/sparklines/sparkline.js')}}"></script>

<!-- jQuery Knob Chart -->
<script src="{{asset('public/backend/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('public/backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('public/backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('public/backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('public/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist/js/adminlte.js')}}"></script>


<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- DataTables -->
<script src="{{asset('public/backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('public/backend/dist/js/toastr.min.js')}}"></script>

<script src="{{asset('public/backend/dist/js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{asset('public/backend/dist/js/typeahead.bundle.min.js')}}"></script>

<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('public/backend/ckfinder/ckfinder.js')}}"></script>

<script src="{{asset('public/backend/dist/js/formValidation.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/morris.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/raphael-min.js')}}"></script>
<script type="text/javascript">
  const ck1 = CKEDITOR.replace('ckeditordesc');
  const ck2 = CKEDITOR.replace('ckeditorcontent');
  const ck3 = CKEDITOR.replace('ckeditordescedit');
  const ck4 = CKEDITOR.replace('ckeditorcontentedit');

  CKFinder.setupCKEditor(ck1);
  CKFinder.setupCKEditor(ck2);
  CKFinder.setupCKEditor(ck3);
  CKFinder.setupCKEditor(ck4);
</script>

<?php if (Session::get('message') != ""){?>
      <script type="text/javascript">
        toastr.error('<?php echo Session::get('message');?>');
      </script>
<?php Session::put('message',null);}?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
  $(function(){
    //Date range picker
    $('#reservationdate1').datetimepicker({
        dateFormat: 'DD/MM/YYYY'
    });
    $('#reservationdate2').datetimepicker({
        dateFormat: 'DD/MM/YYYY'
    });
    $('#reservationdate3').datetimepicker({
        dateFormat: 'DD/MM/YYYY'
    });
    $('#reservationdate4').datetimepicker({
        dateFormat: 'DD/MM/YYYY'
    });

  })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);
                }
            });
        }

      $(document).on('blur','.fee_feeship_edit',function(){
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });
      $('.add_delivery').click(function(){
          var city = $('.city').val();
          var province = $('.province').val();
          var wards = $('.wards').val();
          var fee_ship = $('.fee_ship').val();
          var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                   fetch_delivery();
                    $('#error_feeship').html('<span class="text-danger">Thêm cước phí vận chuyển thành công.</span>');
                }
            });
        });
        $(document).on('click','.delete-fee-ship',function(){
          var feeship_id = $(this).data('feeship_id');
          var _token = $('input[name="_token"]').val();

          if(confirm('Bạn có muốn xóa cước phí vận chuyển này không?')){
            $.ajax({
            url:"{{url('/delete-feeship')}}",
            method:"POST",
            data:{feeship_id:feeship_id,_token:_token},
            success:function(data){
               fetch_delivery();
              $('#error_feeship').html('<span class="text-danger">Xóa cước phí vận chuyển thành công.</span>');
        }
      });

      }
      
    });

      $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);   
                   
                }
            });
        }); 
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    load_gallery();
    function load_gallery(){
      var pro_id = $('.pro_id').val();
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/select-gallery')}}",
        method:"POST",
        data:{pro_id:pro_id,_token:_token},
        success:function(data){
          $('#gallery_load').html(data);
        }
      });
    }

    $('#file').change(function(){
      var error = '';
      var files  = $('#file')[0].files;
      if(files.length > 5) {
        error+='<p>Bạn chỉ được chọn tối đa 5 ảnh</p>';
      } else if(files.length=='') {
        error+='<p>Bạn không được bỏ trống ảnh</p>';
      } else if(file.size >2000000){
        error+='<p>File ảnh được chọn không được phép quá 2MB</p>';
      }
      if(error==''){

      }else{
        $('#file').val();
        $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
        return false;
      }
    });

    $(document).on('blur','.edit_gal_name',function(){
      var gal_id = $(this).data('gal_id');
      var gal_text = $(this).text();
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/update-gallery-name')}}",
        method:"POST",
        data:{gal_id:gal_id,_token:_token,gal_text:gal_text},
        success:function(data){
          load_gallery();
          $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công.</span>');
        }
      });
    });

    $(document).on('click','.delete-gallery',function(){
      var gal_id = $(this).data('gal_id');
      var _token = $('input[name="_token"]').val();
      if(confirm('Bạn có muốn xóa hình ảnh này không?')){
        $.ajax({
        url:"{{url('/delete-gallery')}}",
        method:"POST",
        data:{gal_id:gal_id,_token:_token},
        success:function(data){
          load_gallery();
          $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công.</span>');
        }
      });

      }
      
    });

    $(document).on('change','.file_image',function(){
      var gal_id = $(this).data('gal_id');
      var image = document.getElementById('file-'+gal_id).files[0];
      var form_data = new FormData();
      form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
      form_data.append("gal_id",gal_id);

        $.ajax({
        url:"{{url('/update-gallery')}}",
        method:"POST",
        headers:{
          'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        },
        data:form_data,
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          load_gallery();
          $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công.</span>');
        }
      });

    });

  });
</script>
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
                url : '{{url('/update-qty')}}',
                method: 'POST',
                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                
                success:function(data){
                  alert('Cập nhật số lượng thành công');
                  location.reload();
                }
        });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng tồn trong kho không đủ.');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#FFA500');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                location.reload();
                            }
                });
            
        }

    });
</script>
</body>
</html>
