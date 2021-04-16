@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li class="active">Liên hệ</li>
                        </ul>
                    </div>
                </div>
            </div>
			<div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
                <div class="container mb-60">
                    <div style="width: 100%">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.1932216416058!2d105.72065911538989!3d21.064943591916848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134544d67192907%3A0xaebb53aa417a4231!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBUaMOgbmggxJDDtA!5e0!3m2!1svi!2s!4v1617783945908!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                            <div class="contact-page-side-content">
                                <h3 class="contact-page-title">thoitrang</h3>
                                <p class="contact-page-message mb-25" style="text-align: justify;"> thoitrang - cử hàng online chính hãng, giao hành cực nhanh, uy tín, chuyên nghiệp</p>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-fax"></i> Địa chỉ</h4>
                                    <p>Đà Nẵng - Việt Nam</p>
                                </div>
                                <div class="single-contact-block">
                                    <h4><i class="fa fa-phone"></i> Điện thoại</h4>
                                    <p>Mobile: (+84) 19008886</p>
                                </div>
                                <div class="single-contact-block last-child">
                                    <h4><i class="fa fa-envelope-o"></i> Email</h4>
                                    <p>thoitrang@thoitrang</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                            <div class="contact-form-content pt-sm-55 pt-xs-55">
                                <h3 class="contact-page-title">Để lại tin nhắn cho chúng tôi:</h3>
                                <p style="text-align: justify;">Nếu bạn có điều gì cần góp ý cho thoitrang thì hãy cho chúng tôi biết nhé! Chân thành cảm ơn bạn!</p>
                                <div class="contact-form">
                                    <form action="{{URL::to('/add-contact')}}" method="post">
                                    	{{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Họ và tên của bạn là? <span class="required">*</span></label>
                                            <input type="text" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email của bạn là? <span class="required">*</span></label>
                                            <input type="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Số điện thoại của bạn là?<span class="required">*</span></label>
                                            <input type="text" name="phone" required>
                                        </div>
                                        <div class="form-group mb-30">
                                            <label>Nội dung cụ thể của vấn đề bạn muốn góp ý là?<span class="required">*</span></label>
                                            <textarea name="content" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <p>
                                                <input type="submit" value="Gửi" class="li-btn-3" />
                                            </p>
                                        </div>
                                    </form>
                                </div>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection