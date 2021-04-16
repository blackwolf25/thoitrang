@extends('layout')
@section('contents')
            <div class="li-static-banner pt-20 pt-sm-30 pt-xs-30">
                <div class="container">
                    <div class="row">
                        <!-- Begin Single Banner Area -->
                        @foreach($banner370x230 as $key =>$banner_370x230)
                        <div class="col-lg-4 col-md-4">
                            <div class="single-banner pb-xs-30">
                                <a href="{{$banner_370x230->link}}">
                                    <img src="{{ asset('public/uploads/images/banner/'.$banner_370x230->banner_image) }}" alt="$banner_370x230->banner_name">
                                </a>
                            </div>
                        </div>
                        @endforeach
                        <!-- Single Banner Area End Here -->
                        
                    </div>
                </div>
            </div>
            <!-- Li's Static Banner Area End Here -->
            <!-- Begin Li's Special Product Area -->
            
            
			<section class="product-area li-laptop-product Special-product pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Sản phẩm nổi bật đang được khuyến mãi</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="special-product-active owl-carousel">
                                    @foreach ($product_kmnb as $key =>$pro_nb)
                                    
                                    <form method="post">
                                        @csrf
                                        <input type="hidden" value="{{$pro_nb->product_id}}" class="cart_product_id_{{$pro_nb->product_id}}">
                                        <input type="hidden" value="{{$pro_nb->product_name}}" class="cart_product_name_{{$pro_nb->product_id}}">
                                        <input type="hidden" value="{{$pro_nb->product_image}}" class="cart_product_image_{{$pro_nb->product_id}}">
                                        <input type="hidden" value="{{$pro_nb->product_quantity}}" class="cart_product_quantity_{{$pro_nb->product_id}}">
                                        <input type="hidden" value="{{$pro_nb->product_slug}}" class="cart_product_slug_{{$pro_nb->product_id}}">
                                        <input type="hidden" value="{{$pro_nb->product_nhap}}" class="cart_product_nhap_{{$pro_nb->product_id}}">
                                        @if (!empty($pro_nb->khuyenmai_gia))
                                        <input type="hidden" value="{{$pro_nb->khuyenmai_gia}}" class="cart_product_price_{{$pro_nb->product_id}}">
                                        @else
                                        <input type="hidden" value="{{$pro_nb->product_price}}" class="cart_product_price_{{$pro_nb->product_id}}">
                                        @endif
                                        
                                        <input type="hidden" value="1" class="cart_product_qty_{{$pro_nb->product_id}}">
    
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_nb->product_slug)}}">
                                                    <img src="{{asset('public/uploads/images/product/'.$pro_nb->product_image)}}" alt="{{$pro_nb->product_name}}">
                                                </a>
                                                @if ($pro_nb->product_noibat == 1)
                                                <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{URL::to('/danh-muc-san-pham/'.$pro_nb->slug_category_product)}}">{{$pro_nb->category_name}}</a>
                                                        </h5>
                                                    </div>
                                                    <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$pro_nb->product_slug)}}">{{cutTitle($pro_nb->product_name,10)}}</a></h4>
                                                    <div class="price-box">
                                                        
                                                        @if(!empty($pro_nb->khuyenmai_gia))
                                                        <span class="new-price new-price-2">{{number_format($pro_nb->khuyenmai_gia)}} VNĐ</span>
                                                        <span class="old-price">{{number_format($pro_nb->product_price)}} VNĐ</span>
                                                        <span class="discount-percentage">-  {{round((($pro_nb->product_price - $pro_nb->khuyenmai_gia)/$pro_nb->product_price)*100,0)}} %</span>
                                                        @else
                                                        <span class="new-price">{{number_format($pro_nb->product_price)}} VNĐ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <button data-id_product="{{$pro_nb->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
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
            

            <section class="product-area li-laptop-product li-laptop-product-2 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Sản phẩm đang khuyến mãi</span>
                                </h2>
                                
                            </div>
                            <div class="li-banner-2 pt-15">
                                <div class="row">
                                    <!-- Begin Single Banner Area -->
                                    @foreach($bannerkm as $key => $banner_km)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner">
                                            <a href="{{ $banner_km->link }}">
                                                <img src="{{ asset('public/uploads/images/banner/'.$banner_km->banner_image) }}" alt="$banner_km->banner_name">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Single Banner Area End Here -->
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($product_km as $key =>$pro_km)
                                        
                                        <form method="post">
                                            @csrf
                                            <input type="hidden" value="{{$pro_km->product_id}}" class="cart_product_id_{{$pro_km->product_id}}">
                                            <input type="hidden" value="{{$pro_km->product_name}}" class="cart_product_name_{{$pro_km->product_id}}">
                                            <input type="hidden" value="{{$pro_km->product_image}}" class="cart_product_image_{{$pro_km->product_id}}">
                                            <input type="hidden" value="{{$pro_km->product_quantity}}" class="cart_product_quantity_{{$pro_km->product_id}}">
                                            <input type="hidden" value="{{$pro_km->product_slug}}" class="cart_product_slug_{{$pro_km->product_id}}">
                                            <input type="hidden" value="{{$pro_km->product_nhap}}" class="cart_product_nhap_{{$pro_km->product_id}}">
                                            @if (!empty($pro_km->khuyenmai_gia))
                                            <input type="hidden" value="{{$pro_km->khuyenmai_gia}}" class="cart_product_price_{{$pro_km->product_id}}">
                                            @else
                                            <input type="hidden" value="{{$pro_km->product_price}}" class="cart_product_price_{{$pro_km->product_id}}">
                                            @endif
                                            
                                            <input type="hidden" value="1" class="cart_product_qty_{{$pro_km->product_id}}">
                                        <div class="col-lg-12">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_km->product_slug)}}">
                                                        <img src="{{asset('public/uploads/images/product/'.$pro_km->product_image)}}" alt="{{$pro_km->product_name}}">
                                                    </a>
                                                    @if ($pro_km->product_noibat == 1)
                                                        <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
                                                    @endif
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="{{URL::to('/danh-muc-san-pham/'.$pro_km->slug_category_product)}}">{{$pro_km->category_name}}</a>
                                                            </h5>
                                                        </div>
                                                        <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$pro_km->product_slug)}}">{{cutTitle($pro_km->product_name,10)}}</a></h4>
                                                        <div class="price-box">
                                                            
                                                            @if(!empty($pro_km->khuyenmai_gia))
                                                            <span class="new-price new-price-2">{{number_format($pro_km->khuyenmai_gia)}} VNĐ</span>
                                                            <span class="old-price">{{number_format($pro_km->product_price)}} VNĐ</span>
                                                            <span class="discount-percentage">-  {{round((($pro_km->product_price - $pro_km->khuyenmai_gia)/$pro_km->product_price)*100,0)}} %</span>
                                                            @else
                                                            <span class="new-price">{{number_format($pro_km->product_price)}} VNĐ</span>
                                                            @endif
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <button data-id_product="{{$pro_km->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
            <div class="li-static-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($bannertop as $key => $banner_top)
                                <div class="banner full-width-banner">
                                    <a href="{{$banner_top->link}}">
                                        <img width="100%" src="{{asset('public/uploads/images/banner/'.$banner_top->banner_image)}}">
                                    </a>
                                </div>
                                <!-- /.banner -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <section class="product-area li-laptop-product li-tv-audio-product-2 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Sản phẩm mới</span>
                                </h2>
                                
                            </div>
                            <div class="li-banner-2 pt-15">
                                <div class="row">
                                    <!-- Begin Single Banner Area -->
                                    @foreach($bannernew as $key => $banner_new)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner">
                                            <a href="{{ $banner_new->link }}">
                                                <img src="{{ asset('public/uploads/images/banner/'.$banner_new->banner_image) }}" alt="$banner_new->banner_name">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Single Banner Area End Here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach ($product_new as $key =>$pro_new)
                                    <form method="post">
                                        @csrf
                                        <input type="hidden" value="{{$pro_new->product_id}}" class="cart_product_id_{{$pro_new->product_id}}">
                                        <input type="hidden" value="{{$pro_new->product_name}}" class="cart_product_name_{{$pro_new->product_id}}">
                                        <input type="hidden" value="{{$pro_new->product_image}}" class="cart_product_image_{{$pro_new->product_id}}">
                                        <input type="hidden" value="{{$pro_new->product_quantity}}" class="cart_product_quantity_{{$pro_new->product_id}}">
                                        <input type="hidden" value="{{$pro_new->product_slug}}" class="cart_product_slug_{{$pro_new->product_id}}">
                                        <input type="hidden" value="{{$pro_new->product_nhap}}" class="cart_product_nhap_{{$pro_new->product_id}}">
                                        @if (!empty($pro_new->khuyenmai_gia))
                                        <input type="hidden" value="{{$pro_new->khuyenmai_gia}}" class="cart_product_price_{{$pro_new->product_id}}">
                                        @else
                                        <input type="hidden" value="{{$pro_new->product_price}}" class="cart_product_price_{{$pro_new->product_id}}">
                                        @endif
                                        
                                        <input type="hidden" value="1" class="cart_product_qty_{{$pro_new->product_id}}">

                                        <div class="col-lg-12">
                                            <!-- single-product-wrap start -->
                                            <div class="single-product-wrap">
                                                <div class="product-image">
                                                    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_new->product_slug)}}">
                                                        <img src="{{asset('public/uploads/images/product/'.$pro_new->product_image)}}" alt="{{$pro_new->product_name}}">
                                                    </a>
                                                    @if ($pro_new->product_noibat == 1)
                                                        <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
                                                    @endif
                                                </div>
                                                <div class="product_desc">
                                                    <div class="product_desc_info">
                                                        <div class="product-review">
                                                            <h5 class="manufacturer">
                                                                <a href="{{URL::to('/danh-muc-san-pham/'.$pro_new->slug_category_product)}}">{{$pro_new->category_name}}</a>
                                                            </h5>
                                                        </div>
                                                         <div class="price-box">
                                                            
                                                            @if(!empty($pro_new->khuyenmai_gia))
                                                            <span class="new-price new-price-2">{{number_format($pro_new->khuyenmai_gia)}} VNĐ</span>
                                                            <span class="old-price">{{number_format($pro_new->product_price)}} VNĐ</span>
                                                            <span class="discount-percentage">-  {{round((($pro_new->product_price - $pro_new->khuyenmai_gia)/$pro_new->product_price)*100,0)}} %</span>
                                                            @else
                                                            <span class="new-price">{{number_format($pro_new->product_price)}} VNĐ</span>
                                                            @endif
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="add-actions">
                                                        <ul class="add-actions-link">
                                                            <button data-id_product="{{$pro_new->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
            
            <div class="li-static-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach($bannerdown as $key => $banner_down)
                                <div class="banner full-width-banner">
                                    <a href="{{$banner_down->link}}">
                                        <img width="100%" src="{{asset('public/uploads/images/banner/'.$banner_down->banner_image)}}">
                                    </a>
                                </div>
                                <!-- /.banner -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Li's Static Home Area End Here -->
            <!-- Begin Li's Trending Product | Home V2 Area -->
            <section class="product-area li-trending-product li-trending-product-2 pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Tab Menu Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Sản phẩm được khách hàng tin dùng nhiều nhất</span>
                                </h2>
                                             
                            </div>
                            <div class="li-banner-2 pt-15">
                                <div class="row">
                                    <!-- Begin Single Banner Area -->
                                    @foreach($bannerbc as $key => $banner_bc)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-banner">
                                            <a href="{{ $banner_bc->link }}">
                                                <img src="{{ asset('public/uploads/images/banner/'.$banner_bc->banner_image) }}" alt="{{$banner_bc->banner_name}}">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Single Banner Area End Here -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                            @foreach ($product_bc as $key =>$pro_bc)
                                                <form method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$pro_bc->product_id}}" class="cart_product_id_{{$pro_bc->product_id}}">
                                                    <input type="hidden" value="{{$pro_bc->product_name}}" class="cart_product_name_{{$pro_bc->product_id}}">
                                                    <input type="hidden" value="{{$pro_bc->product_image}}" class="cart_product_image_{{$pro_bc->product_id}}">
                                                    <input type="hidden" value="{{$pro_bc->product_quantity}}" class="cart_product_quantity_{{$pro_bc->product_id}}">
                                                    <input type="hidden" value="{{$pro_bc->product_slug}}" class="cart_product_slug_{{$pro_bc->product_id}}">
                                                    <input type="hidden" value="{{$pro_bc->product_nhap}}" class="cart_product_nhap_{{$pro_bc->product_id}}">
                                                    @if (!empty($pro_bc->khuyenmai_gia))
                                                    <input type="hidden" value="{{$pro_bc->khuyenmai_gia}}" class="cart_product_price_{{$pro_bc->product_id}}">
                                                    @else
                                                    <input type="hidden" value="{{$pro_bc->product_price}}" class="cart_product_price_{{$pro_bc->product_id}}">
                                                    @endif
                                                    
                                                    <input type="hidden" value="1" class="cart_product_qty_{{$pro_bc->product_id}}">
                                                    
                                                    <div class="col-lg-12">
                                                        <!-- single-product-wrap start -->
                                                        <div class="single-product-wrap">
                                                            <div class="product-image">
                                                                <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_bc->product_slug)}}">
                                                                    <img src="{{asset('public/uploads/images/product/'.$pro_bc->product_image)}}" alt="{{$pro_bc->product_name}}">
                                                                </a>
                                                                @if ($pro_bc->product_noibat == 1)
                                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
                                                                @endif
                                                            </div>
                                                            <div class="product_desc">
                                                                <div class="product_desc_info">
                                                                    <div class="product-review">
                                                                        <h5 class="manufacturer">
                                                                            <a href="{{URL::to('/danh-muc-san-pham/'.$pro_bc->slug_category_product)}}">{{$pro_bc->category_name}}</a>
                                                                        </h5>
                                                                    </div>
                                                                    <div class="price-box">
                                                                        
                                                                        @if(!empty($pro_bc->khuyenmai_gia))
                                                                        <span class="new-price new-price-2">{{number_format($pro_bc->khuyenmai_gia)}} VNĐ</span>
                                                                        <span class="old-price">{{number_format($pro_bc->product_price)}} VNĐ</span>
                                                                        <span class="discount-percentage">-  {{round((($pro_bc->product_price - $pro_bc->khuyenmai_gia)/$pro_bc->product_price)*100,0)}} %</span>
                                                                        @else
                                                                        <span class="new-price">{{number_format($pro_bc->product_price)}} VNĐ</span>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul class="add-actions-link">
                                                                        <button data-id_product="{{$pro_bc->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- single-product-wrap end -->
                                                    </div>
                                                </form>
                                            @endforeach

                                </div>
                            </div>
                                    
                                
                        </div>
                        <!-- Tab Menu Area End Here -->
                    </div>
                </div>
            </section> 				

@endsection