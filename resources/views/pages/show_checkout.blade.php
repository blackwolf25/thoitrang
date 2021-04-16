@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                            <li class="active">Thanh toán</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Checkout Area Strat-->
            <div class="checkout-area pt-60 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <form {{-- action="{{URL::to('/dat-hang')}}" --}} method="post">
                            	{{csrf_field()}}
                                <div class="checkbox-form">
                                    <h3>Chi tiết đơn hàng</h3>
                                    
                                    <h6>Giao hàng đến: </h6>
                                        <div class="row">
                                            {{-- <form method="post">
                                                {{ csrf_field() }} --}}
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Thành phố / Tỉnh </label>
                                                        <select name="city" id="city" class="form-control is-warning choose city">
                                                            <option value="">----- Chọn Tỉnh / Thành phố -----</option>
                                                            @foreach($city as $key => $ci)
                                                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Quận / Huyện / Thị xã </label>
                                                        <select name="province" id="province" class="form-control is-warning province choose">
                                                            <option value="">----- Chọn Quận / Huyện / Thị xã -----</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Phường/ Xã / Thị trấn </label>
                                                        <select name="wards" id="wards" class="form-control is-warning wards">
                                                            <option value="">----- Chọn Phường/ Xã / Thị trấn -----</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="button" value="TÍNH PHÍ VẬN CHUYỂN" name="calculate_order" class="btn btn-warning calculate_delivery">
                                                </div>
                                            {{-- </form> --}}
                                            <hr>
                                            <div class="col-md-12">
                                                <h6>Thông tin người mua hàng: </h6>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Họ và tên của người mua hàng <span class="required">*</span></label>
                                                    <input value="{{old('shipping_name')}}" name="shipping_name" class="shipping_name" placeholder="Nhập họ và tên người mua hàng" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Địa chỉ của người mua hàng <span class="required">*</span></label>
                                                    <input value="{{old('shipping_address')}}" name="shipping_address" class="shipping_address" placeholder="Nhập địa chỉ người mua hàng" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Số điện thoại của người mua hàng <span class="required">*</span></label>
                                                    <input value="{{old('shipping_phone')}}" name="shipping_phone" class="shipping_phone" placeholder="Nhập số điện thoại người mua hàng" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="checkout-form-list">
                                                    <label>Địa chỉ email của người mua hàng <span class="required">*</span></label>
                                                    <input value="{{old('shipping_email')}}" name="shipping_email" class="shipping_email" placeholder="Nhập email người mua hàng" type="text" required>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    
                                    <br>

                                    <div class="col-md-12">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Ghi chú đơn hàng ( ghi rõ size, màu )</label>
                                                <textarea name="shipping_notes"  class="shipping_notes" id="checkout-mess" cols="30" rows="10" placeholder="Nhập những thông tin cần lưu ý về đơn hàng hay giao hàng cho Quý khách."></textarea>
                                            </div>
                                        </div>
                                        @if(Session::get('fee'))
                                            <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                                        @else
                                            <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                        @endif
                                        
                                        @if(Session::get('coupon'))
                                            @foreach(Session::get('coupon') as $key =>$cou)
                                                <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="order_coupon" class="order_coupon" value="">
                                        @endif
                                    
                                    </div>
                                </div>
                            
                                </div>
                                <div class="col-lg-6 col-12">
                                {{-- <form method="POST">
                                    {{ csrf_field() }} --}}
                                        <div class="your-order">
                                            <h3>Đơn hàng của bạn:</h3>
                                            <div class="your-order-table table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center"; class="cart-product-name"><strong>Sản phẩm</strong></th>
                                                            <th></th>
                                                            <th class="cart-product-total"><strong>Thành tiền</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                                    $total = 0;
                                                        @endphp
                                                        @foreach(Session::get('cart') as $key => $cart)
                                                                @php
                                                                    $subtotal = $cart['product_price']*$cart['product_qty'];
                                                                    $total+=$subtotal;
                                                                @endphp
                                                        <tr class="cart_item">
                                                          <td style="text-align: justify;" class="cart-product-name"> {{cutTitle($cart['product_name'],4)}}<strong class="product-quantity"></strong></td><td><Strong> × {{$cart['product_qty']}}</strong></td>
                                                          <td style="text-align: right;" class="cart-product-total"><span class="amount">{{number_format($subtotal,0,',','.')}} VNĐ</span></td>  
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="cart-subtotal">
                                                            <th><strong>Tổng tiền sản phẩm:</strong></th>
                                                            <td colspan="2" style="text-align: right;"><span class="amount"><strong>{{number_format($total,0,',','.')}} VNĐ</strong></span></td>
                                                        </tr>
                                                        @if (Session::get('coupon'))
                                                        <tr class="cart-subtotal">   
                                                            <th><strong>Tiền giảm khuyến mãi:</strong></th>
                                                            @foreach(Session::get('coupon') as $key => $cou)
                                                                    @if($cou['coupon_condition']==0)
                                                                        @php
                                                                            echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>Miễn phí vận chuyển</strong></span></td>';
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>'.number_format(Session::get('total_coupon'),0,',','.').' VNĐ</strong></span></td>';
                                                                        @endphp
                                                                    @endif
                                                            @endforeach
                                                        </tr>
                                                        @endif

                                                        <tr class="cart-subtotal">   
                                                            <th><strong>Phí vận chuyển:</strong></th>
                                                            @if ( (Session::get('fee')) && !(Session::get('coupon')) )
                                                                @php
                                                                    echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>'.number_format(Session::get('fee'),0,',','.'). ' VNĐ</strong></span></td>';
                                                                @endphp

                                                            @elseif ( !(Session::get('fee')) && (Session::get('coupon')) )
                                                                @foreach(Session::get('coupon') as $key => $cou)
                                                                    @if($cou['coupon_condition']==0)
                                                                        @php
                                                                        $fee = 0;
                                                                        Session::put('fee',$fee);
                                                                        echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>'.number_format(Session::get('fee'),0,',','.'). ' VNĐ</strong></span></td>';
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>Quý khách chưa nhập thông tin để vận chuyển</strong></span></td>';
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            @elseif ( (Session::get('fee')) && (Session::get('coupon')) )
                                                                @foreach(Session::get('coupon') as $key => $cou)
                                                                    @if($cou['coupon_condition']==0)
                                                                        @php
                                                                        $fee = 0;
                                                                        Session::put('fee',$fee);
                                                                        echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>'.number_format(Session::get('fee'),0,',','.'). ' VNĐ</strong></span></td>';
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>'.number_format(Session::get('fee'),0,',','.'). ' VNĐ</strong></span></td>';
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            @elseif ( !(Session::get('fee')) && !(Session::get('coupon')) )
                                                                @php
                                                                    echo '<td colspan="2" style="text-align: right;"><span class="amount"><strong>Quý khách chưa nhập thông tin để vận chuyển</strong></span></td>';
                                                                @endphp
                                                            @endif
                                                        </tr>

                                                        <tr class="order-total">
                                                            <th><strong>Thành tiền</strong></th>
                                                            <td colspan="2" style="text-align: right;"><strong><span class="amount" style="color: orange">{{number_format($total-(Session::get('total_coupon'))+(Session::get('fee')),0,',','.')}} VNĐ</span></strong></td>
                                                            @php
                                                        		$order_total=$total-(Session::get('total_coupon'))+(Session::get('fee'));
                                                        		Session::put('order_total',$order_total);
                                                    		@endphp
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <h3>Hình thức thanh toán:</h3>
                                            <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div>
                                                        <select name="shipping_method" id="shipping_method" class="order-button-payment shipping_method">
                                                            <option value="2">Thanh toán bằng tiền mặt</option>
                                                            <option value="1">Thanh toán bằng ví điện tử.</option>
                                                            <option value="0"> Chuyển khoản thông qua ngân hàng.</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    
                                                    <div class="order-button-payment">
                                                    	<a>
                                                        <input value="Đặt hàng" type="button" name="send_order" class="btn btn-warning send_order">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                {{-- </form> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection