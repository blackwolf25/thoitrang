@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            @foreach ($brand_name as $key =>$cate_id)                          
                            <li class="active">{{$cate_id->brand_name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- Begin Li's Content Wraper Area -->
            <div class="content-wraper pt-60 pb-60 pt-sm-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 order-1 order-lg-2">
                            <!-- Begin Li's Banner Area -->
                            <div class="single-banner shop-page-banner">
                            	@foreach ($brand_name as $key =>$cateid)
                                <a href="#">
                                    <img src="{{ asset('/public/uploads/images/brand/'.$cateid->brand_image) }}">
                                </a>
                                @endforeach
                            </div>
                            <!-- Li's Banner Area End Here -->
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar mt-30">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sắp xếp theo</p>
                                        <select class="nice-select">
                                            <option value="trending">Mới nhất</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            <div class="shop-products-wrapper">
                                <div class="tab-content">
                                    <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                        <div class="product-area shop-product-area">
                                            <div class="row">
                                            	@foreach ($brand_by_id as $key =>$cate_id)
                                                <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                                    <form>
                                                            {{csrf_field()}}
                                                            <input type="hidden" value="{{$cate_id->product_id}}" class="cart_product_id_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_name}}" class="cart_product_name_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_image}}" class="cart_product_image_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_quantity}}" class="cart_product_quantity_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_slug}}" class="cart_product_slug_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_nhap}}" class="cart_product_nhap_{{$cate_id->product_id}}">
                                                            @if (!empty($cate_id->khuyenmai_gia))
                                                            <input type="hidden" value="{{$cate_id->khuyenmai_gia}}" class="cart_product_price_{{$cate_id->product_id}}">
                                                            @else
                                                            <input type="hidden" value="{{$cate_id->product_price}}" class="cart_product_price_{{$cate_id->product_id}}">
                                                            @endif
                                                            
                                                            <input type="hidden" value="1" class="cart_product_qty_{{$cate_id->product_id}}">
                                                    <!-- single-product-wrap start -->
                                                    <div class="single-product-wrap">
                                                        <div class="product-image">
                                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$cate_id->product_slug)}}">
                                                                <img src="{{asset('public/uploads/images/product/'.$cate_id->product_image)}}">
                                                            </a>
                                                            @if ($cate_id->product_noibat == 1)
			                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
			                                                @endif
                                                        </div>
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    <h5 class="manufacturer">
                                                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate_id->slug_category_product)}}">{{$cate_id->category_name}}</a>
                                                                    </h5>
                                                                    
                                                                </div>
                                                                <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$cate_id->product_slug)}}">{{cutTitle($cate_id->product_name,10)}}</a></h4>
                                                                <div class="price-box">
                                                                    @if(!empty($cate_id->khuyenmai_gia))
			                                                        <span class="new-price new-price-2">{{number_format($cate_id->khuyenmai_gia)}} VNĐ</span>
			                                                        <span class="old-price">{{number_format($cate_id->product_price)}} VNĐ</span>
			                                                        <span class="discount-percentage">-  {{round((($cate_id->product_price - $cate_id->khuyenmai_gia)/$cate_id->product_price)*100,0)}} %</span>
			                                                        @else
			                                                        <span class="new-price">{{number_format($cate_id->product_price)}} VNĐ</span>
			                                                        @endif
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul class="add-actions-link">
                                                                    <li class="add-cart active"><button data-id_product="{{$cate_id->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <!-- single-product-wrap end -->
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane fade product-list-view" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                            	@foreach ($brand_by_id as $key =>$cate_id)
                                                <form>
                                                            {{csrf_field()}}
                                                            <input type="hidden" value="{{$cate_id->product_id}}" class="cart_product_id_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_name}}" class="cart_product_name_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_image}}" class="cart_product_image_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_quantity}}" class="cart_product_quantity_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_slug}}" class="cart_product_slug_{{$cate_id->product_id}}">
                                                            <input type="hidden" value="{{$cate_id->product_nhap}}" class="cart_product_nhap_{{$cate_id->product_id}}">
                                                            @if (!empty($cate_id->khuyenmai_gia))
                                                            <input type="hidden" value="{{$cate_id->khuyenmai_gia}}" class="cart_product_price_{{$cate_id->product_id}}">
                                                            @else
                                                            <input type="hidden" value="{{$cate_id->product_price}}" class="cart_product_price_{{$cate_id->product_id}}">
                                                            @endif
                                                            
                                                            <input type="hidden" value="1" class="cart_product_qty_{{$cate_id->product_id}}">
                                                <div class="row product-layout-list">
                                                    <div class="col-lg-3 col-md-5 ">
                                                        <div class="product-image">
                                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$cate_id->product_slug)}}">
                                                                <img src="{{asset('public/uploads/images/product/'.$cate_id->product_image)}}">
                                                            </a>
                                                             @if ($cate_id->product_noibat == 1)
			                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
			                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-7">
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    <h5 class="manufacturer">
                                                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate_id->slug_category_product)}}">{{$cate_id->category_name}}</a>
                                                                    </h5>
                                                                </div>
                                                                <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$cate_id->product_slug)}}">{{cutTitle($cate_id->product_name,10)}}</a></h4>
                                                                <div class="price-box">
                                                                    @if(!empty($cate_id->khuyenmai_gia))
			                                                        <span class="new-price new-price-2">{{number_format($cate_id->khuyenmai_gia)}} VNĐ</span>
			                                                        <span class="old-price">{{number_format($cate_id->product_price)}} VNĐ</span>
			                                                        <span class="discount-percentage">-  {{round((($cate_id->product_price - $cate_id->khuyenmai_gia)/$cate_id->product_price)*100,0)}} %</span>
			                                                        @else
			                                                        <span class="new-price">{{number_format($cate_id->product_price)}} VNĐ</span>
			                                                        @endif
                                                                </div>
                                                                <p>{!! cutTitle($cate_id->product_desc,30) !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="row">   
                                                                    
                                                            <ul class="add-actions-link">
                                                             
                                                                <li>
                                                                    <div>
                                                                      <button data-id_product="{{$cate_id->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>  
                                                                    </div>
                                                                    
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paginatoin-area">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 pt-xs-15">
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <ul class="pagination-box pt-xs-20 pb-xs-15">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop-products-wrapper end -->
                        </div>
                        
                    </div>
                </div>
            </div>
@endsection