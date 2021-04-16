@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li class="active">Giỏ hàng</li>
                        </ul>
                    </div>
                </div>
            </div>

           
                    
             
            <!--Shopping Cart Area Strat-->
            <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{URL::to('/update-cart')}}" method="post">
                                @csrf
                                <div class="table-content table-responsive">
                                    <div>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="li-product-thumbnail">Hình ảnh sản phẩm</th>
                                                    <th class="cart-product-name">Tên sản phẩm</th>
                                                    <th class="li-product-price">Đơn giá</th>
                                                    <th class="li-product-quantity">Số lượng</th>
                                                    <th class="li-product-subtotal">Thành tiền</th>
                                                    <th class="li-product-remove">Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty(Session::get('cart')))
                                                @php
                                                        $total = 0;
                                                        $total_nhap = 0;
                                                @endphp
                                                @foreach(Session::get('cart') as $key => $cart)
                                                    @php
                                                        $subtotal = $cart['product_price']*$cart['product_qty'];
                                                        $total+=$subtotal;
                                                        $subtotal_nhap = $cart['product_nhap']*$cart['product_qty'];
                                                        $total_nhap+=$subtotal_nhap;
                                                    @endphp
                                                <tr>
                                                    <td class="li-product-thumbnail"><a href="{{url::to('/chi-tiet-san-pham/'.$cart['product_slug'])}}"><img width="100px" src="{{asset('public/uploads/images/product/'.$cart['product_image'])}}" alt="{{$cart['product_name']}}"></a></td>
                                                    <td class="li-product-name"><a href="{{url::to('/chi-tiet-san-pham/'.$cart['product_slug'])}}">{{$cart['product_name']}}</a></td>
                                                    <td class="li-product-price"><span class="amount">{{number_format($cart['product_price'],0,',','.')}} VNĐ</span></td>

                                                    <td class="quantity">
                                                        <!--<form action="" method="POST">-->
                                                        <div class="cart-plus-minus">
                                                            <input class="cart-plus-minus-box cart_quantity" type="text" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                        </div>
                                                        
                                                        <!--</form>-->
                                                    </td>
                                                    <td class="product-subtotal"><span class="amount">{{number_format($subtotal,0,',','.')}} VNĐ</span></td>
                                                    <td class="li-product-remove"><a href="{{ URL::to('/delete-pro/'.$cart['session_id']) }}"><i class="fa fa-trash"></i></a></td>
                                                </tr>
                                                @endforeach
                                                @else 
                                                <tr>
                                                    <td colspan="6">
                                                        <center>
                                                            @php 
                                                                echo 'Giỏ hàng của Quý khách đang trống.';
                                                            @endphp
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    @if(!empty(Session::get('cart')))
                                    <div>
                                        <div class="col-12">
                                            <div class="coupon-all">
                                                <div class="coupon">
                                                    <a class="btn btn-warning" href="{{url('/del-all-product')}}">HỦY GIỎ HÀNG</a>
                                                </div>                                                
                                                <div class="coupon2">
                                                    <input class="button" name="update_qty" value="Cập nhật giỏ hàng" type="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </form>
                            @if(!empty(Session::get('cart')))
                            <hr>
                            <form method="post" action="{{URL::to('/check-coupon')}}">
                                @csrf
                                {{-- @php
                                    Session::put('coupon','');
                                @endphp --}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                <input id="coupon_code" class="input-text" name="coupon" value="" placeholder="Nhập mã khuyến mãi" type="text">
                                                    <input class="button" name="apply_coupon" value="Sử dụng mã" type="submit">
                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <div class="coupon">
                                                @if (!empty(Session::get('coupon')))
                                                    <a href="{{URL::to('/unset-coupon')}}" class="btn btn-danger">HUỶ MÃ KHUYẾN MÃI</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="#">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total">
                                            <h2>Tổng hóa đơn</h2>
                                            <ul>
                                                <li>Sản phẩm: <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
                                                @php
                                                        $total_coupon = 0;
                                                        $total_thanhtoan = 0;
                                                @endphp
                                                @if (!empty(Session::get('coupon')))
                                                    
                                                    @foreach(Session::get('coupon') as $key => $cou)
                                                        @if($cou['coupon_condition']==0)
                                                            @php

                                                                $total_coupon = 0;
                                                                Session::put('total_coupon',$total_coupon);
                                                                echo '<li>Mã khuyến mãi: <span>Miễn phí vận chuyển</span></li>';
                                                            @endphp   

                                                        @elseif($cou['coupon_condition']==1)
                                                            <li>Mã khuyến mãi: <span>- {{$cou['coupon_number']}} %</span></li> 
                                                                @php 
                                                                $total_coupon = ($total*$cou['coupon_number'])/100;
                                                                Session::put('total_coupon',$total_coupon);
                                                                echo '<li>Tiền giảm:<span>'.number_format($total_coupon,0,',','.').' VNĐ</span></li>';
                                                                @endphp                                                            
                                                        @else
                                                            @php
                                                                $total_coupon = $cou['coupon_number'];
                                                                Session::put('total_coupon',$total_coupon);
                                                                echo '<li>Mã khuyến mãi: <span>- '.number_format($total_coupon,0,',','.').' VNĐ</span></li>';
                                                            @endphp
                                                        @endif

                                                    @endforeach
                                                
                                                
                                                @endif
                                                @if (empty(Session::get('coupon')))
                                                    @php 
                                                    Session::put('coupon','');
                                                    @endphp

                                                @endif
                                                
                                                <li>Tổng tiền cần thanh toán: <span>{{number_format($total-$total_coupon,0,',','.')}} VNĐ</span></li>
                                            </ul>
                                            		@php
                                            		    Session::put('order_nhap',$total_nhap);
                                            		@endphp
                                                    @if (!empty(Session::get('customer_id')))
                                                        <a href="{{URL::to('/thanh-toan')}}">Tiến hành thanh toán</a>
                                                    @endif
                                                    @if (empty(Session::get('customer_id')))
                                                        <a href="{{URL::to('/dangnhap-dangky-thanhtoan')}}">Đăng nhập để thanh toán</a>
                                                    @endif
                                                   
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
@endsection