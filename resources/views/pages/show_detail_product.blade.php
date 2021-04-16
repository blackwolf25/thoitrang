@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            @foreach ($product_details as $key =>$procate)
	                            <li><a href="{{URL::to('/danh-muc-san-pham/'.$procate->slug_category_product)}}">{{$procate->category_name}}</a></li>
                            @endforeach
                            @foreach ($product_details as $key =>$proname)
                                <li class="active">
		                            <a href="{{URL::to('/chi-tiet-san-pham/'.$proname->product_slug)}}">
		                            {{$proname->product_name}}</a>
		                        </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- content-wraper start -->
            <div class="content-wraper">
                <div class="container">
                    <div class="row single-product-area">
                        <div class="col-lg-5 col-md-6">
                           <!-- Product Details Left -->
                            <div class="product-details-left pt-60">
                                <div class="product-details-thumbs slider-thumbs-1">
                                    @foreach($product_details as $key =>$pro1)
                                    <div class="sm-image"><img width="474" src="{{ asset('public/uploads/images/product/'.$pro1->product_image) }}" alt="product image thumb"></div>
                                    @foreach($gallery as $key =>$gal1)
                                    <div class="sm-image"><img width="474" src="{{ asset('public/uploads/images/gallery/'.$gal1->gallery_image) }}" alt="product image thumb"></div>
                                    @endforeach
                                    @endforeach
                                    
                                </div>
                                
                                <br>

                                <div class="product-details-images slider-navigation-1">
                                    @foreach($product_details as $key =>$pro2)
                                    <div class="lg-image">
                                        <a class="popup-img venobox vbox-item" href="{{ asset('public/uploads/images/product/'.$pro2->product_image) }}" data-gall="myGallery">
                                            <img width="100" src="{{ asset('public/uploads/images/product/'.$pro2->product_image) }}" alt="product image">
                                        </a>
                                    </div>
                                    @foreach($gallery as $key =>$gal2)
                                    <div class="lg-image">
                                        <a class="popup-img venobox vbox-item" href="{{ asset('public/uploads/images/gallery/'.$gal2->gallery_image) }}" data-gall="myGallery">
                                            <img width="100" src="{{ asset('public/uploads/images/gallery/'.$gal2->gallery_image) }}" alt="product image">
                                        </a>
                                    </div>
                                    @endforeach
                                    @endforeach
                                    
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>
                        @foreach ($product_details as $key => $product_by_id)
                        <div class="col-lg-7 col-md-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2 style="text-align: justify;">{{ $product_by_id->product_name}}</h2>
                                    <span class="product-details-ref">
                                    	<a href="{{URL::to('/thuong-hieu-san-pham/'.$product_by_id->brand_slug)}}"><img width="100px" alt="brand" src="{{URL::to('public/uploads/images/brand/'.$product_by_id->brand_image)}}"></a>
                                    	<a href="{{URL::to('/thuong-hieu-san-pham/'.$product_by_id->brand_slug)}}">  Nhà sản xuất: {{$product_by_id->brand_name}}</a></span>
                                    
                            
                                    <div class="price-box pt-20">
                                    	@if (!empty($product_by_id->khuyenmai_gia))
                                    		<span class="new-price new-price-2">Giá hiện tại: <strong>{{number_format($product_by_id->khuyenmai_gia)}} VNĐ</strong></span>
                                    		<span class="old-price">Giá cũ: {{number_format($product_by_id->product_price)}} VNĐ</span>
                                    	@else
                                    		<span class="new-price new-price-2">Giá hiện tại: <strong>{{number_format($product_by_id->product_price)}} VNĐ</strong></span>
                                    	@endif
                                        
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span> {!!$product_by_id->product_desc!!} </span>
                                        </p>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="{{ URL::to('/gio-hang') }}" class="cart-quantity" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$product_by_id->product_slug}}" class="cart_product_slug_{{$product_by_id->product_id}}">
                                            
                                            <input type="hidden" value="{{$product_by_id->product_id}}" class="cart_product_id_{{$product_by_id->product_id}}">
                                            <input type="hidden" value="{{$product_by_id->product_name}}" class="cart_product_name_{{$product_by_id->product_id}}">
                                            <input type="hidden" value="{{$product_by_id->product_image}}" class="cart_product_image_{{$product_by_id->product_id}}">
                                            <input type="hidden" value="{{$product_by_id->product_quantity}}" class="cart_product_quantity_{{$product_by_id->product_id}}">
                                            <input type="hidden" value="{{$product_by_id->product_price}}" class="cart_product_price_{{$product_by_id->product_id}}">
                                            <input type="hidden" value="{{$product_by_id->product_nhap}}" class="cart_product_nhap_{{$product_by_id->product_id}}">
                                            <div class="quantity">
                                                <label>Số lượng</label>
                                                <div class="cart-plus-minus">
                                                    <input name="qty" class="cart-plus-minus-box cart_product_qty_{{$product_by_id->product_id}}" min="1" value="1" type="text">
                                                    <input type="hidden" name="productid_hidden" value="{{$product_by_id->product_id}}">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="button" value="Thêm vào giỏ hàng" class="btn btn-warning add-to-cart" data-id_product="{{$product_by_id->product_id}}" name="add-to-cart">
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                       
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="standard" data-action="like" data-size="large" data-share="true"></div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- content-wraper end -->
            <!-- Begin Product Area -->
            @foreach ($product_details as $key => $product_by_id)
            <div class="product-area pt-35">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="li-product-tab">
                                <ul class="nav li-product-menu">
                                   <li><a class="active" data-toggle="tab" href="#description"><span>Mô tả sản phẩm</span></a></li>
                                   <li><a data-toggle="tab" href="#product-details"><span>Chi tiết sản phẩm</span></a></li>
                                   <li><a data-toggle="tab" href="#reviews"><span>Bình luận</span></a></li>
                                </ul>               
                            </div>
                            <!-- Begin Li's Tab Menu Content Area -->
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="description" class="tab-pane active show" role="tabpanel">
                            <div class="product-description">
                                <span>{!!$product_by_id->product_desc!!}</span>
                            </div>
                        </div>
                        <div id="product-details" class="tab-pane" role="tabpanel">
                            <div class="product-details-manufacturer">
                               	{!!$product_by_id->product_content!!}
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane" role="tabpanel">
                            <div class="product-reviews">
                                <div class="product-details-comment-block">
                                    <div class="col-lg-12">
                                    <div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width="100%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Product Area End Here -->
            <!-- Begin Li's Laptop Product Area -->
            <section class="product-area li-laptop-product pt-30 pb-50">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Các sản phẩm tương tự:</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($related as $key => $lienquan)
                                    <form method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                                                    <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                                                    <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                                                    <input type="hidden" value="{{$lienquan->product_slug}}" class="cart_product_slug_{{$lienquan->product_id}}">
                                                    <input type="hidden" value="{{$lienquan->product_quantity}}" class="cart_product_quantity_{{$lienquan->product_id}}">
                                                    <input type="hidden" value="{{$lienquan->product_nhap}}" class="cart_product_nhap_{{$lienquan->product_id}}">
                                                    @if (!empty($lienquan->khuyenmai_gia))
                                                    <input type="hidden" value="{{$lienquan->khuyenmai_gia}}" class="cart_product_price_{{$lienquan->product_id}}">
                                                    @else
                                                    <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                                                    @endif
                                                    
                                                    <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">
                                                    <img src="{{asset('public/uploads/images/product/'.$lienquan->product_image)}}" alt="{{$lienquan->product_name}}">
                                                </a>
                                                @if ($lienquan->product_noibat == 1)
                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{URL::to('/danh-muc-san-pham/'.$lienquan->slug_category_product)}}">{{$lienquan->category_name}}</a>
                                                        </h5>
                                                    </div>
                                                    <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->product_slug)}}">{{cutTitle($lienquan->product_name,10)}}</a></h4>
                                                    <div class="price-box">
                                                        
                                                        @if(!empty($lienquan->khuyenmai_gia))
                                                        <span class="new-price new-price-2">{{number_format($lienquan->khuyenmai_gia)}} VNĐ</span>
                                                        <span class="old-price">{{number_format($lienquan->product_price)}} VNĐ</span>
                                                        <span class="discount-percentage">-  {{round((($lienquan->product_price - $lienquan->khuyenmai_gia)/$lienquan->product_price)*100,0)}} %</span>
                                                        @else
                                                        <span class="new-price">{{number_format($lienquan->product_price)}} VNĐ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <button data-id_product="{{$lienquan->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                        <!-- single-product-wrap end -->
                                    </div>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>             
@endsection