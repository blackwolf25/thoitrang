<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>QUẢN LÝ HỆ THỐNG thoitrang</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link rel="shortcut icon" href="{{asset('public/uploads/images/website/uiuy.png')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}">
  <!-- Toast -->
  <link rel="stylesheet" href="{{asset('public/backend/dist/css/toastr.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{URL::to('/admin')}}"><b><strong>thoitrang</strong></b>.COM</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Đăng nhập để vào hệ thống</p>

      <form action="{{URL::to('/admin-dashboard')}}" method="post">
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="admin_email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="admin_password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12" style="text-align: center;">
            <button style="color: white" type="submit" class="btn btn-warning btn-block"><i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập</button>
          </div>
        </div>
        <br>
        {{-- <div class="row">
          <div class="col-12" style="text-align: center; width:100%">
          <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
          <br>
          @if($errors->has('g-recaptcha-response'))
          <span class="invalid-feedback" style="display:block">
            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
          </span>
          @endif
          </div>
        </div> --}}
          
          <!-- /.col -->
      </form>

      

      <p class="mb-1">
        <a href="{{URL::to('/admin-forgot-password')}}">Quên mật khẩu?</a>
      </p>
      <p class="mb-0">
        <a href="{{URL::to('/admin-register')}}" class="text-center">Đăng ký tài khoản mới.</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/backend/dist/js/adminlte.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('public/backend/dist/js/toastr.min.js')}}"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>  
<?php if (Session::get('message') != ""){?>
      <script type="text/javascript">
        toastr.error('<?php echo Session::get('message');?>');
      </script>
      <?php Session::put('message',null);}?>

</body>
</html>