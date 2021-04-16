
<!doctype html>
<html lang="vi">
    
<!-- index-231:32-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>thoitrang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="{{$meta_desc}}"/>
        <meta name="keywords" content="{{$meta_keywords}}"/>
        <meta name="title" content="{{$meta_title}}"/>
        <meta name="author" content="Trùm Store">
        <meta name="robots" content="INDEX,FOLLOW"/>
        <meta rel="canonical" href="{{$url_canonical}}">
       
        <meta property="og:site_name" content="{{$url_canonical}}" />
        <meta property="og:description" content="{{$meta_desc}}" />
        <meta property="og:title" content="{{$meta_title}}" />
        <meta property="og:url" content="{{$url_canonical}}" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="{{$image_og}}" />

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/uploads/images/website/uiuy.png')}}">
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/material-design-iconic-font.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="{{asset('public/frontend/css/fontawesome-stars.css')}}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/meanmenu.css')}}">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/slick.css')}}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.min.css')}}">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/venobox.css')}}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/helper.css')}}">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">
        <!-- Sweet Alert CSS -->
        <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}">
        <!-- Modernizr js -->
        <script src="{{asset('public/frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <!-- Toast -->
        <link rel="stylesheet" href="{{asset('public/backend/dist/css/toastr.min.css')}}">

        <link rel="stylesheet" href="{{asset('public/frontend/css/lightslider.min.css')}}">
        <!-- Hotline -->
        <div class="hotline-phone-ring-wrap">       
            <div class="hotline-phone-ring">
                <div class="hotline-phone-ring-circle"></div>
                <div class="hotline-phone-ring-circle-fill"></div>
                <div class="hotline-phone-ring-img-circle"> <a href="tel:0765369013" class="pps-btn-img"> <img src="{{asset('public/uploads/images/website/icon.png')}}" alt="so dien thoai" width="50"> </a></div>
            </div>      
            <div class="hotline-bar"> 
                <a href="tel:0765369013"> <span class="text-hotline">19008886</span> </a>
            </div>
        </div>
        <div class="float-icon-hotline">            
            <!--<ul class ="left-icon hotline">
                <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://zalo.me/0986369013"><i class="fa fa-zalo animated infinite tada"></i><span>Zalo</span></a></li>
                <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="https://www.messenger.com/t/vkumedia"><i class="fa fa-messenger animated infinite tada"></i><span>Facebook</span></a></li>
                <li class="hotline_float_icon"><a target="_blank" rel="nofollow" id="messengerButton" href="mailto:thoitrang@thoitrang"><i class="fa fa-gmail animated infinite tada"></i><span>Gmail</span></a></li>
            </ul>  
            -->     
        </div>
        <div id="fb-root"></div>
    </head>
    <body>
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            <header>
                <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span>Đường dây nóng: </span><a href="tel:0765369013">(+84) 19008886</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        @if (empty(Session::get('customer_id')))
                                            <li>
                                                <span class="ht-setting-trigger">Kính chào: Quý khách đã đến với thoitrang</span>
                                            </li>
                                            <li>
                                                <a href="{{URL::to('/dangnhap-dangky-taikhoan')}}"><span class=" ">Đăng ký</span></a>
                                            </li>
                                            <li>
                                                <a href="{{URL::to('/dangnhap-dangky-taikhoan')}}"><span class=" ">Đăng nhập</span></a>
                                            </li>
                                        @endif
                                        @if (!empty(Session::get('customer_id')))
                                            <li>
                                                <span class="ht-setting-trigger">Kính chào: {{Session::get('customer_name')}} đã đến với thoitrang</span>
                                            </li>
                                            <li>
                                                <span class=" "><a href="{{URL::to('/logout')}}">Đăng xuất</a></span>
                                            </li>
                                        @endif
                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="{{URL::to('/trang-chu')}}">
                                        <img width="190px" height="45px" src="{{asset('public/uploads/images/website/uiuy.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-6">
                                <!-- Begin Header Middle Searchbox Area -->
                                
                                <div class="logo pb-sm-30 pb-xs-30">
                                <div class="header-middle-right">
                                <form action="{{url::to('/tim-kiem')}}" class="hm-searchbox" method="post">
                                    {{ csrf_field()}}
                                    
                                    <input name="search_product" type="text" placeholder="Nhập tên sản phẩm cần tìm ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                </div>
                                </div>
                                
                            </div>
                            <div class="col-lg-3">
                                <!-- Header Middle Searchbox Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                        <!-- Begin Header Middle Wishlist Area -->
                                       
                                        <!-- Header Middle Wishlist Area End Here -->
                                        <!-- Begin Header Mini Cart Area -->
                                        <li class="hm-minicart" style="background-color:pink;">
                                            <div class="btn btn-danger" style="background-color:blue;">
                                                
                                                <a href="{{URL::to('/gio-hang')}}"><span style="color: white" class="fa fa-shopping-cart"> GIỎ HÀNG</span></a>
                                                
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky d-none d-lg-block" style="background-color:pink;">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12" style="background-color:pink;">
                                <!-- Begin Header Bottom Menu Area -->
                                <div class="hb-menu hb-menu-2 d-xl-block"  style="background-color:pink;">
                                    <nav>
                                        <ul>
                                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                                            <li><a href="{{URL::to('/tin-tuc')}}">Tin tức</a></li>
                                            <li><a href="{{URL::to('/lien-he')}}">Liên hệ</a></li>
                                            <li><a href="{{URL::to('/chi-tiet-bai-viet/gioi-thieu-cua-hang')}}">Giới Thiệu</a></li>
                                            <!-- Begin Header Bottom Menu Information Area -->
                                            
                                            <!-- Header Bottom Menu Information Area End Here -->
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                    <div class="container"> 
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </header>
            <!-- Header Area End Here -->
            <!-- Begin Slider With Category Menu Area -->
            <div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Category Menu Area -->
                        <div class="col-lg-3">
                            <!--Category Menu Start-->
                            <div class="category-menu">
                                <div class="category-heading">
                                    <h2 class="categories-toggle" style="background-color:pink;"><span>Danh mục sản phẩm</span></h2>
                                </div>
                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>                                       
                                        @php
                                        $i=0;
                                        @endphp
                                        @foreach ($category as $key =>$cate)
                                        @php
                                            $i++;
                                        @endphp 
                                        @if ($cate->category_parent == 0)                                      
                                        <li class="{{ $i>5 ? 'rx-child' : '' }}"><a href="{{url::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{ $cate->category_name}}</a></li>
                                            
                                            
                                                @foreach($category as $key =>$cate_sub)
                                                    @if($cate_sub->category_parent==$cate->category_id)
                                                        <li class="{{ $i>5 ? 'rx-child' : '' }}"> 
                                                            <a href="{{url::to('/danh-muc-san-pham/'.$cate_sub->slug_category_product)}}">--- {{ $cate_sub->category_name}}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            
                                        @endif
                                        @endforeach

                                        <li class="rx-parent">
                                            <a class="rx-default">Mở rộng</a>
                                            <a class="rx-show">Thu hẹp</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                            <!--Category Menu End-->
                        </div>
                        <!-- Category Menu Area End Here -->
                        <!-- Begin Slider Area -->
                        <div class="col-lg-9">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($slider as $key =>$slider)
                                    @php
                                        $i++;
                                    @endphp
                                    <div class="carousel-item {{$i==1 ? 'active' : ''}}">
                                        <a href="{{$slider->link}}">
                                        <img class="d-block w-100" src="{{ asset('public/uploads/images/slider/'.$slider->slider_image) }}">
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider With Category Menu Area End Here -->
            <!-- Begin Li's Static Banner Area -->
            
            @yield('contents')
            
            <!-- Li's Trending Product | Home V2 Area End Here -->
            <!-- Begin Footer Area -->
            <div class="footer">
                <!-- Begin Footer Static Top Area -->
                <div class="footer-static-top">
                    <div class="container">
                        <!-- Begin Footer Shipping Area -->
                        <div class="footer-shipping pt-60 pb-55 pb-xs-25">
                            <div class="row">
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('public/frontend/images/shipping-icon/1.png')}}" alt="Shipping Icon')}}">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Vận chuyển</h2>
                                            <p style="text-align: justify;">Miễn phí vận chuyển với tổng giá trị đơn hàng trên 199.000 VNĐ.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('public/frontend/images/shipping-icon/2.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Thanh toán an toàn</h2>
                                            <p style="text-align: justify;">Thanh toán bằng các phương thức thanh toán an toàn và phổ biến nhất thế giới.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('public/frontend/images/shipping-icon/3.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Tự tin mua sắm</h2>
                                            <p style="text-align: justify;">Bảo vệ khách hàng mua hàng từ khi nhấp chuột đến khi giao hàng.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('public/frontend/images/shipping-icon/4.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Hỗ trợ 24/7</h2>
                                            <p style="text-align: justify;">Nếu bạn có thắc mắc nào, xin hãy liên lạc với chúng tôi qua nhiều kênh thông tin khác nhau.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                            </div>
                        </div>
                        <!-- Footer Shipping Area End Here -->
                    </div>
                </div>
                <!-- Footer Static Top Area End Here -->
                <!-- Begin Footer Static Middle Area -->
                <div class="footer-static-middle">
                    <div class="container">
                        <div class="footer-logo-wrap pt-50 pb-35">
                            <div class="row">
                                <!-- Begin Footer Logo Area -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="footer-logo">
                                        <img width="300 px" src="{{asset('public/uploads/images/website/uiuy.png')}}" alt="trumpoppers.com">
                                        <p class="info" style="text-align: justify;">
                                            thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp
                                        </p>
                                    </div>
                                    <ul class="des">
                                        <li>
                                            <span>Địa chỉ: </span>
                                           Đà Nẵng - Việt Nam
                                        </li>
                                        <li>
                                            <span>Điện thoại: </span>
                                            <a href="tel:0765369013">(+84) 19008886</a>
                                        </li>
                                        <li>
                                            <span>Email: </span>
                                            <a href="mailto://thoitrang@thoitrang">thoitrang@thoitrang</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Footer Logo Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-4">
                                    <div style="text-align: center;">
                                            <div class="fb-page" data-href="https://www.facebook.com/vkumedia/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/vkumedia/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/vkumedia/">thoitrang</a></blockquote></div>
                                        
                                    </div>
                                </div>
                                <!-- Footer Block Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-4">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Liên hệ chúng tôi</h3>
                                        <ul class="social-link">
                                            <li class="twitter">
                                                <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="rss">
                                                <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google +">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                                    <i class="fa fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Begin Footer Newsletter Area -->
                                    <div class="footer-newsletter">
                                        <h4 style="text-align: justify;">Đăng ký để nhận thông tin và <strong> nhận giảm giá 10% cho đơn hàng đầu tiên.</strong></h4>

                                        <form action="{{URL::to('/email')}}" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                                            {{ csrf_field() }}
                                            <div id="mc_embed_signup_scroll">
                                              <div id="mc-form" class="mc-form subscribe-form form-group" >
                                                <input name="email" id="mc-email" type="email" autocomplete="off" placeholder="Bạn vui lòng điện email của bạn vào đây..." />
                                                <button type="submit" class="btn" id="mc-submit">Đăng ký</button>
                                              </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- Footer Newsletter Area End Here -->
                                </div>
                                <!-- Footer Block Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Static Middle Area End Here -->
                <!-- Begin Footer Static Bottom Area -->
                <div class="footer-static-bottom pt-55 pb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">                                
                                <!-- Begin Footer Payment Area -->
                                <div class="copyright text-center">
                                    <a href="#">
                                        <img src="{{asset('public/frontend/images/payment/1.png')}}" alt="">
                                    </a>
                                </div>
                                <!-- Footer Payment Area End Here -->
                                <!-- Begin Copyright Area -->
                                <div class="copyright text-center pt-25">
                                    <span><a target="_blank" href="{{url::to('/trang-chu')}}">Bản quyền thuộc vềHuỳnh Đức</a></span>
                                </div>
                                <!-- Copyright Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Static Bottom Area End Here -->
            </div>
            <!-- Footer Area End Here -->
        </div>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="{{asset('public/frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <!-- Popper js -->
        <script src="{{asset('public/frontend/js/vendor/popper.min.js')}}"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
        <!-- Ajax Mail js -->
        <script src="{{asset('public/frontend/js/ajax-mail.js')}}"></script>
        <!-- Meanmenu js -->
        <script src="{{asset('public/frontend/js/jquery.meanmenu.min.js')}}"></script>
        <!-- Wow.min js -->
        <script src="{{asset('public/frontend/js/wow.min.js')}}"></script>
        <!-- Slick Carousel js -->
        <script src="{{asset('public/frontend/js/slick.min.js')}}"></script>
        <!-- Owl Carousel-2 js -->
        <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
        <!-- Magnific popup js -->
        <script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
        <!-- Isotope js -->
        <script src="{{asset('public/frontend/js/isotope.pkgd.min.js')}}"></script>
        <!-- Imagesloaded js -->
        <script src="{{asset('public/frontend/js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- Mixitup js -->
        <script src="{{asset('public/frontend/js/jquery.mixitup.min.js')}}"></script>
        <!-- Countdown -->
        <script src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>
        <!-- Counterup -->
        <script src="{{asset('public/frontend/js/jquery.counterup.min.js')}}"></script>
        <!-- Waypoints -->
        <script src="{{asset('public/frontend/js/waypoints.min.js')}}"></script>
        <!-- Barrating -->
        <script src="{{asset('public/frontend/js/jquery.barrating.min.js')}}"></script>
        <!-- Jquery-ui -->
        <script src="{{asset('public/frontend/js/jquery-ui.min.js')}}"></script>
        <!-- Venobox -->
        <script src="{{asset('public/frontend/js/venobox.min.js')}}"></script>
        <!-- Nice Select js -->
        <script src="{{asset('public/frontend/js/jquery.nice-select.min.js')}}"></script>
        <!-- ScrollUp js -->
        <script src="{{asset('public/frontend/js/scrollUp.min.js')}}"></script>
        <!-- Main/Activator js -->
        <script src="{{asset('public/frontend/js/main.js')}}"></script>
        <!-- Sweet Alert js -->
        <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
        <!-- Toastr -->
        <script src="{{asset('public/backend/dist/js/toastr.min.js')}}"></script>

        <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
        <?php if (Session::get('message') != ""){?>
            <script type="text/javascript">
                toastr.info('<?php echo Session::get('message');?>');
            </script>
        <?php Session::put('message',null);}?>
        
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0" nonce="bPpukzrQ"></script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $('.add-to-cart').click(function(){
                    var id = $(this).data('id_product');
                    var cart_product_id = $('.cart_product_id_' + id).val();
                    var cart_product_name = $('.cart_product_name_' + id).val();
                    var cart_product_image = $('.cart_product_image_' + id).val();
                    var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                    var cart_product_price = $('.cart_product_price_' + id).val();
                    var cart_product_slug = $('.cart_product_slug_' + id).val();
                    var cart_product_qty = $('.cart_product_qty_' + id).val();
                    var cart_product_nhap = $('.cart_product_nhap_' + id).val();
                    var _token = $('input[name="_token"]').val();
                    if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                        alert('Làm ơn đặt số lượng nhỏ hơn ' + cart_product_quantity+' sản phẩm.');
                    }else{

                        $.ajax({
                            url: '{{url('/add-cart-ajax')}}',
                            method: 'POST',
                            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_nhap:cart_product_nhap,cart_product_qty:cart_product_qty,_token:_token,cart_product_slug:cart_product_slug,cart_product_quantity:cart_product_quantity
                            },
                            success:function(){

                                swal({
                                        title: "Đã thêm sản phẩm vào giỏ hàng",
                                        text: "Bạn có thể xem tiếp hoặc tiến hành thanh toán",
                                        showCancelButton: true,
                                        cancelButtonClass: "btn-danger",
                                        cancelButtonText: "Xem tiếp",
                                        confirmButtonClass: "btn-warning",
                                        confirmButtonText: "Thanh toán",
                                        closeOnConfirm: false
                                    },
                                    function() {
                                        window.location.href = "{{url('/gio-hang')}}";
                                    });

                            }

                        });
                    }

                    
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
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
                    url : '{{url('/select-delivery-home')}}',
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
                $('.calculate_delivery').click(function(){
                    var matp = $('.city').val();
                    var maqh = $('.province').val();
                    var xaid = $('.wards').val();
                    var _token = $('input[name="_token"]').val();
                    if(matp == '' && maqh =='' && xaid ==''){
                        alert('Làm ơn chọn các thông tin để tính phí vận chuyển.');
                    }else{
                        $.ajax({
                        url : '{{url('/calculate-fee')}}',
                        method: 'POST',
                        data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                        success:function(){
                           location.reload(); 
                        }
                        });
                    } 
            });
        });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.send_order').click(function(){
                    swal({
                        title: "Xác nhận đơn hàng",
                        text: "Quý khách có muốn mua hàng không?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Có",
                        cancelButtonClass:  "btn-danger",
                        cancelButtonText: "Không",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm){
                         if (isConfirm) {
                            var shipping_email = $('.shipping_email').val();
                            var shipping_name = $('.shipping_name').val();
                            var shipping_address = $('.shipping_address').val();
                            var shipping_phone = $('.shipping_phone').val();
                            var shipping_notes = $('.shipping_notes').val();
                            var shipping_method = $('.shipping_method').val();
                            
                            var order_fee = $('.order_fee').val();
                            var order_coupon = $('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{url('/confirm-order')}}',
                                method: 'POST',
                                data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                                success:function(){
                                   swal("Xác nhận đơn hàng", "Đơn hàng của Quý khách đã được gửi thành công. Quý khách vui lòng đợi 3 giây để hệ thống cập nhật đơn hàng của Quý khách.", "success");
                                }
                            });

                            window.setTimeout(function(){ 
                                location.href = "{{url('/cam-on')}}";
                            } ,3000);

                          } else {
                            swal("Hủy đơn hàng", "Đơn hàng của Quý khách đã được hủy", "error");

                          }
                  
                    });

                   
                });
            });
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:3,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }   
            });  
          });
        </script>

    
</html>
