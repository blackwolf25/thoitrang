@extends('layout')
@section('contents')
			
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li><a>Kết quả tìm kiếm</a></li>                            
                        </ul>
                    </div>
                </div>
            </div>
			<div class="content-wraper pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
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
                                            	@foreach ($search_product as $key =>$pro_se)
                                            		{{csrf_field()}}
                                                            <input type="hidden" value="{{$pro_se->product_id}}" class="cart_product_id_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_name}}" class="cart_product_name_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_image}}" class="cart_product_image_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_quantity}}" class="cart_product_quantity_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_slug}}" class="cart_product_slug_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_nhap}}" class="cart_product_nhap_{{$pro_se->product_id}}">
                                                            @if (!empty($pro_se->khuyenmai_gia))
                                                            <input type="hidden" value="{{$pro_se->khuyenmai_gia}}" class="cart_product_price_{{$pro_se->product_id}}">
                                                            @else
                                                            <input type="hidden" value="{{$pro_se->product_price}}" class="cart_product_price_{{$pro_se->product_id}}">
                                                            @endif
                                                            
                                                            <input type="hidden" value="1" class="cart_product_qty_{{$pro_se->product_id}}">
                                            	
                                                <div class="col-lg-3 col-md-4 col-sm-6 mt-40">
                                                    <!-- single-product-wrap start -->
                                                    <div class="single-product-wrap">
                                                        <div class="product-image">
                                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_se->product_slug)}}">
                                                                <img src="{{asset('public/uploads/images/product/'.$pro_se->product_image)}}">
                                                            </a>
                                                            @if ($pro_se->product_noibat == 1)
			                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
			                                                @endif
                                                        </div>
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    <h5 class="manufacturer">
                                                                        <a href="{{URL::to('/danh-muc-san-pham/'.$pro_se->slug_category_product)}}">{{$pro_se->category_name}}</a>
                                                                    </h5>
                                                                </div>
                                                                <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$pro_se->product_slug)}}">{{cutTitle($pro_se->product_name,10)}}</a></h4>
                                                                <div class="price-box">
                                                                    @if(!empty($pro_se->khuyenmai_gia))
			                                                        <span class="new-price new-price-2">{{number_format($pro_se->khuyenmai_gia)}} VNĐ</span>
			                                                        <span class="old-price">{{number_format($pro_se->product_price)}} VNĐ</span>
			                                                        <span class="discount-percentage">-  {{round((($pro_se->product_price - $pro_se->khuyenmai_gia)/$pro_se->product_price)*100,0)}} %</span>
			                                                        @else
			                                                        <span class="new-price">{{number_format($pro_se->product_price)}} VNĐ</span>
			                                                        @endif
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul class="add-actions-link">
                                                                    <li class="add-cart active"><button data-id_product="{{$pro_se->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- single-product-wrap end -->
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                            	@foreach ($search_product as $key =>$pro_se)
                                                {{csrf_field()}}
                                                            <input type="hidden" value="{{$pro_se->product_id}}" class="cart_product_id_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_name}}" class="cart_product_name_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_image}}" class="cart_product_image_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_quantity}}" class="cart_product_quantity_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_slug}}" class="cart_product_slug_{{$pro_se->product_id}}">
                                                            <input type="hidden" value="{{$pro_se->product_nhap}}" class="cart_product_nhap_{{$pro_se->product_id}}">
                                                            @if (!empty($pro_se->khuyenmai_gia))
                                                            <input type="hidden" value="{{$pro_se->khuyenmai_gia}}" class="cart_product_price_{{$pro_se->product_id}}">
                                                            @else
                                                            <input type="hidden" value="{{$pro_se->product_price}}" class="cart_product_price_{{$pro_se->product_id}}">
                                                            @endif
                                                            
                                                            <input type="hidden" value="1" class="cart_product_qty_{{$pro_se->product_id}}">


                                                <div class="row product-layout-list">
                                                    <div class="col-lg-3 col-md-5 ">
                                                        <div class="product-image">
                                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$pro_se->product_slug)}}">
                                                                <img src="{{asset('public/uploads/images/product/'.$pro_se->product_image)}}">
                                                            </a>
                                                            @if ($pro_se->product_noibat == 1)
			                                                    <span class="sticker"><i style="color: yellow" class="fa fa-star"></i></span>
			                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-7">
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    <h5 class="manufacturer">
                                                                        <a href="{{URL::to('/danh-muc-san-pham/'.$pro_se->slug_category_product)}}">{{$pro_se->category_name}}</a>
                                                                    </h5>
                                                                </div>
                                                                <h4><a class="product_name" href="{{URL::to('/chi-tiet-san-pham/'.$pro_se->product_slug)}}">{{cutTitle($pro_se->product_name,10)}}</a></h4>
                                                                <div class="price-box">
                                                                    @if(!empty($pro_se->khuyenmai_gia))
			                                                        <span class="new-price new-price-2">{{number_format($pro_se->khuyenmai_gia)}} VNĐ</span>
			                                                        <span class="old-price">{{number_format($pro_se->product_price)}} VNĐ</span>
			                                                        <span class="discount-percentage">-  {{round((($pro_se->product_price - $pro_se->khuyenmai_gia)/$pro_se->product_price)*100,0)}} %</span>
			                                                        @else
			                                                        <span class="new-price">{{number_format($pro_se->product_price)}} VNĐ</span>
			                                                        @endif
                                                                </div>
                                                                <p style="text-align: justify;">{!! $pro_se->product_desc !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="shop-add-action mb-xs-30">
                                                            <ul class="add-actions-link">
                                                                <?php if ($pro_se->product_quantity>0){
                                                                        $tinhtrang="Còn hàng";
                                                                    }else{
                                                                        $tinhtrang="Hết hàng";
                                                                    }
                                                                    ?>
                                                                
                                                                <a style="text-align: center;">Tình trạng: {{$tinhtrang}}</a>

                                                                <li>
                                                                    <div>
                                                                      <button data-id_product="{{$pro_se->product_id}}" style="font-size: 14px" type="button" class="btn btn-warning add-to-cart" name="add-to-cart">Thêm giỏ hàng</button>  
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paginatoin-area">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <ul class="pagination-box">
                                                    
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