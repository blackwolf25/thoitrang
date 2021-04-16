@extends('layout')
@section('contents')
@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li class="active">Đăng nhập hoặc đăng ký tài khoản</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- Begin Login Content Area -->
            <div class="page-section mb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                            <!-- Login Form s-->
                            <form action="{{URL::to('/dang-nhap')}}" method="POST">
								{{ csrf_field() }}
                                <div class="login-form">
                                    <h4 class="login-title">Đăng nhập</h4>
                                    <div class="row">
                                        <div class="col-md-12 col-12 mb-20">
                                            <label>Email*</label>
                                            <input name="email_account" class="mb-0" type="email" placeholder="Nhập địa chỉ email của bạn" required>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <label>Mật khẩu</label>
                                            <input name="password_account" class="mb-0" type="password" placeholder="Nhập mật khẩu" required>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                                <input type="checkbox" id="remember_me">
                                                <label for="remember_me">Nhớ đăng nhập</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                            <a href="#"> Quên mật khẩu?</a>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="register-button mt-0">Đăng nhập</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                            <form action="{{URL::to('/dang-ky')}}" method="POST">
								{{ csrf_field() }}
                                <div class="login-form">
                                    <h4 class="login-title">Đăng ký</h4>
                                    <div class="row">
                                        <div class="col-md-12 mb-20">
                                            <label>Họ và tên của bạn</label>
                                            <input name="customer_name" class="mb-0" type="text" placeholder="Nhập họ và tên của bạn" required>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Email Address*</label>
                                            <input name="customer_email" class="mb-0" type="email" placeholder="Nhập địa chỉ email của bạn"required>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Mật khẩu</label>
                                            <input name="customer_password" class="mb-0" type="password" placeholder="Nhập mật khẩu" required>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Số điện thoại</label>
                                            <input name="customer_phone" class="mb-0" type="text" placeholder="Nhập số điện thoại của bạn" required>
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label>Địa chỉ nơi bạn đang sinh sống</label>
                                            <input name="customer_add" class="mb-0" type="text" placeholder="Nhập địa chỉ nơi bạn đang sinh sống" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="register-button mt-0">Đăng ký</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection                  

@endsection