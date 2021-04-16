<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>QUẢN LÝ HỆ THỐNG thoitrang</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('public/uploads/images/website/uiuy.png')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}" />
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" />
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('public/backend/dist/css/adminlte.min.css')}}" />
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
               <a href="{{URL::to('/admin')}}"><b><strong>VKUBOOKSTORE</strong></b>.COM</a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">Đăng ký tài khoản mới</p>

                    <form action="{{URL::to('/add-admin')}}" method="post">
                        {{ csrf_field() }}
                        <div class="input-group mb-3">
                            <input value="{{old('admin_name')}}" name="admin_name" type="text" class="form-control" placeholder="Họ và tên" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input value="{{old('admin_email')}}" name="admin_email" type="email" class="form-control" placeholder="Email" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input value="{{old('admin_password')}}" name="admin_password" type="password" class="form-control" placeholder="Mật khẩu" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input value="{{old('admin_dateofbirth')}}" name="admin_dateofbirth" type="text" class="form-control" placeholder="Nhập tháng / ngày / năm sinh" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-calendar"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input value="{{old('admin_phone')}}" name="admin_phone" type="text" class="form-control" placeholder="Số điện thoại" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input value="{{old('admin_add')}}" name="admin_add" type="text" class="form-control" placeholder="Địa chỉ" required="" />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-home"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree" required="" />
                                    <label for="agreeTerms"> Đồng ý với <a href="" data-toggle="modal" data-target="#modal-xl-dieukhoan">điều khoản</a> </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-warning btn-block" >Đăng ký</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <a href="{{URL::to('/admin')}}" class="text-center">Tôi đã có tài khoản</a>
                </div>
                <!-- /.form-box -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.register-box -->

        <!-- jQuery -->
        <script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('public/backend/dist/js/adminlte.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{asset('public/backend/dist/js/toastr.min.js')}}"></script>

        <?php if (Session::get('message') != ""){?>
              <script type="text/javascript">
                toastr.error('<?php echo Session::get('message');?>');
              </script>
              <?php Session::put('message',null);}?>
<div class="modal fade" id="modal-xl-dieukhoan">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Điều khoản thoitrang</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Nội dung các điều khoản:</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Ch&agrave;o mừng qu&iacute; kh&aacute;ch đến mua sắm tại thoitrang. Sau khi truy cập v&agrave;o website thoitrang để tham khảo hoặc mua sắm, qu&iacute; kh&aacute;ch đ&atilde; đồng &yacute; tu&acirc;n thủ v&agrave; r&agrave;ng buộc với những quy định của thoitrang. Vui l&ograve;ng xem kỹ c&aacute;c quy định v&agrave; hợp t&aacute;c với ch&uacute;ng t&ocirc;i để x&acirc;y dựng 1 website thoitrang ng&agrave;y c&agrave;ng th&acirc;n thiện v&agrave; phục vụ tốt những y&ecirc;u cầu của ch&iacute;nh qu&iacute; kh&aacute;ch. Ngo&agrave;i ra, nếu c&oacute; bất cứ c&acirc;u hỏi n&agrave;o về những thỏa thuận tr&ecirc;n đ&acirc;y, vui l&ograve;ng email cho ch&uacute;ng t&ocirc;i qua địa chỉ <a href="mailto:thoitrang@gmail.com">thoitrang@gmail.com</a>.</span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><strong><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>T&agrave;i khoản của kh&aacute;ch h&agrave;ng</span></strong></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Khi sử dụng dịch vụ thoitrang, qu&iacute; kh&aacute;ch sẽ cung cấp cho ch&uacute;ng t&ocirc;i th&ocirc;ng tin về địa chỉ email, mật khẩu v&agrave; họ t&ecirc;n để c&oacute; được 1 t&agrave;i khoản tại đ&acirc;y. Việc sử dụng v&agrave; bảo mật th&ocirc;ng tin t&agrave;i khoản l&agrave; tr&aacute;ch nhiệm v&agrave; quyền lợi của qu&iacute; kh&aacute;ch khi sử dụng thoitrang. Ngo&agrave;i ra, những th&ocirc;ng tin kh&aacute;c trong t&agrave;i khoản như t&ecirc;n tuổi, địa chỉ.... l&agrave; những th&ocirc;ng tin sẽ gi&uacute;p thoitrang phục vụ qu&iacute; kh&aacute;ch tốt nhất. Trong trường hợp th&ocirc;ng tin do qu&iacute; kh&aacute;ch cung cấp kh&ocirc;ng đầy đủ hoặc sai dẫn đến việc kh&ocirc;ng thể giao h&agrave;ng cho qu&iacute; kh&aacute;ch, ch&uacute;ng t&ocirc;i c&oacute; quyền đ&igrave;nh chỉ hoặc từ chối phục vụ, giao h&agrave;ng m&agrave; kh&ocirc;ng phải chịu bất cứ tr&aacute;ch nhiệm n&agrave;o đối với qu&iacute; kh&aacute;ch. Khi c&oacute; những thay đổi th&ocirc;ng tin của qu&iacute; kh&aacute;ch, vui l&ograve;ng cập nhật lại th&ocirc;ng tin trong t&agrave;i khoản tại thoitrang. Qu&iacute; kh&aacute;ch phải giữ k&iacute;n mật khẩu v&agrave; t&agrave;i khoản, ho&agrave;n to&agrave;n chịu tr&aacute;ch nhiệm đối với tất cả c&aacute;c hoạt động diễn ra th&ocirc;ng qua việc sử dụng mật khẩu hoặc t&agrave;i khoản của m&igrave;nh. Qu&iacute; kh&aacute;ch n&ecirc;n đảm bảo tho&aacute;t khỏi t&agrave;i khoản tại thoitrang sau mỗi lần sử dụng để bảo mật th&ocirc;ng tin của m&igrave;nh</span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><strong><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Quyền lợi bảo mật th&ocirc;ng tin của kh&aacute;ch h&agrave;ng</span></strong></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Khi sử dụng dịch vụ tại website thoitrang, qu&iacute; kh&aacute;ch được đảm bảo rằng những th&ocirc;ng tin cung cấp cho ch&uacute;ng t&ocirc;i sẽ chỉ được d&ugrave;ng để n&acirc;ng cao chất lượng dịch vụ d&agrave;nh cho kh&aacute;ch h&agrave;ng của thoitrang v&agrave; sẽ kh&ocirc;ng được chuyển giao cho 1 b&ecirc;n thứ ba n&agrave;o kh&aacute;c v&igrave; mục đ&iacute;ch thương mại. Th&ocirc;ng tin của qu&iacute; kh&aacute;ch tại thoitrang sẽ được ch&uacute;ng t&ocirc;i bảo mật v&agrave; chỉ trong trường hợp ph&aacute;p luật y&ecirc;u cầu, ch&uacute;ng t&ocirc;i sẽ buộc phải cung cấp những th&ocirc;ng tin n&agrave;y cho c&aacute;c cơ quan ph&aacute;p luật.</span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><strong><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Tr&aacute;ch nhiệm của kh&aacute;ch h&agrave;ng khi sử dụng dịch vụ của thoitrang</span></strong></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Qu&iacute; kh&aacute;ch tuyệt đối kh&ocirc;ng được sử dụng bất kỳ c&ocirc;ng cụ, phương ph&aacute;p n&agrave;o để can thiệp, x&acirc;m nhập bất hợp ph&aacute;p v&agrave;o hệ thống hay l&agrave;m thay đổi cấu tr&uacute;c dữ liệu tại website thoitrang. Qu&iacute; kh&aacute;ch kh&ocirc;ng được c&oacute; những h&agrave;nh động (thực hiện, cổ vũ) việc can thiệp, x&acirc;m nhập dữ liệu của thoitrang cũng như hệ thống m&aacute;y chủ của ch&uacute;ng t&ocirc;i. Ngo&agrave;i ra, xin vui l&ograve;ng th&ocirc;ng b&aacute;o cho quản trị web của thoitrang ngay khi qu&iacute; kh&aacute;ch ph&aacute;t hiện ra lỗi hệ thống theo số điện thoại 19008886 hoặc email <a href="mailto:thoitrang@gmail.com">thoitrang@gmail.com</a></span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Qu&iacute; kh&aacute;ch kh&ocirc;ng được đưa ra những nhận x&eacute;t, đ&aacute;nh gi&aacute; c&oacute; &yacute; x&uacute;c phạm, quấy rối, l&agrave;m phiền hoặc c&oacute; bất cứ h&agrave;nh vi n&agrave;o thiếu văn h&oacute;a đối với người kh&aacute;c. Kh&ocirc;ng n&ecirc;u ra những nhận x&eacute;t c&oacute; t&iacute;nh ch&iacute;nh trị ( tuy&ecirc;n truyền, chống ph&aacute;, xuy&ecirc;n tạc ch&iacute;nh quyền), kỳ thị t&ocirc;n gi&aacute;o, giới t&iacute;nh, sắc tộc.... Tuyệt đối cấm mọi h&agrave;nh vi mạo nhận, cố &yacute; tạo sự nhầm lẫn m&igrave;nh l&agrave; một kh&aacute;ch h&agrave;ng kh&aacute;c hoặc l&agrave; th&agrave;nh vi&ecirc;n Ban Quản Trị thoitrang</span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><strong><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Tr&aacute;ch nhiệm v&agrave; quyền lợi của thoitrang</span></strong></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>Trong trường hợp c&oacute; những ph&aacute;t sinh ngo&agrave;i &yacute; muốn hoặc tr&aacute;ch nhiệm của m&igrave;nh, thoitrang sẽ kh&ocirc;ng chịu tr&aacute;ch nhiệm về mọi tổn thất ph&aacute;t sinh. Ngo&agrave;i ra, ch&uacute;ng t&ocirc;i kh&ocirc;ng cho ph&eacute;p c&aacute;c tổ chức, c&aacute; nh&acirc;n kh&aacute;c quảng b&aacute; sản phẩm tại website thoitrang m&agrave; chưa c&oacute; sự đồng &yacute; bằng văn bản từ thoitrang.. C&aacute;c thỏa thuận v&agrave; quy định trong Điều khoản sử dụng c&oacute; thể thay đổi v&agrave;o bất cứ l&uacute;c n&agrave;o nhưng sẽ được thoitrang th&ocirc;ng b&aacute;o cụ thể tr&ecirc;n website thoitrang</span></p>
                                            <p style='margin-top:0in;margin-right:0in;margin-bottom:8.0pt;margin-left:0in;line-height:107%;font-size:15px;text-align:justify;'><span style='font-size:16px;line-height:107%;font-family:"Times New Roman",serif;'>&nbsp;</span></p>
                                      </p>
                                    </div>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">ĐÓNG</button>
                                </div>
                              </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
</div>
    </body>
</html>
