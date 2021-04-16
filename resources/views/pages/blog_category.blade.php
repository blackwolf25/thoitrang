@extends('layout')
@section('contents')
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li><a href="{{URL::to('/tin-tuc')}}">Tin tức</a></li>
                            @foreach ($blog_category_name as $key =>$blogname)
	                            <li class="active">
	                            	<a href="{{URL::to('/danh-muc-tin-tuc/'.$blogname->slug_category_post)}}">{{$blogname->category_name}}</a>
	                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
			<div class="li-main-blog-page pt-60 pb-55">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Main Content Area -->
                        <div class="col-lg-12">
                            <div class="row li-main-content">
                            	@foreach ($blog_category as $key =>$blogcate)
                                <div class="col-lg-4 col-md-6">
                                    <div class="li-blog-single-item pb-25">
                                        <div class="li-blog-banner">
                                            <a href="{{url::to('/chi-tiet-bai-viet/'.$blogcate->post_slug)}}"><img class="img-full" src="{{asset('public/uploads/images/post/'.$blogcate->post_image)}}" alt=""></a>
                                        </div>
                                        <div class="li-blog-content">
                                            <div class="li-blog-details">
                                                <h3 class="li-blog-heading pt-25"><a href="{{url::to('/chi-tiet-bai-viet/'.$blogcate->post_slug)}}" style="text-align: justify;">{{cutTitle($blogcate->post_name,5)}}</a></h3>
                                                <div class="li-blog-meta">
                                                    <a class="author" href="#"><i class="fa fa-user"></i>{{$blogcate->post_author}}</a>
                                                    <a class="post-time" href="#"><i class="fa fa-calendar"></i>{{date($blogcate->post_created_at)}}</a>
                                                </div>
                                                <p style="text-align: justify;">{!!cutTitle($blogcate->post_desc,20)!!}</p>
                                                <a class="read-more" href="{{url::to('/chi-tiet-bai-viet/'.$blogcate->post_slug)}}">Chi tiết...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               	@endforeach
                                <!-- Begin Li's Pagination Area -->
                                <div class="col-lg-12">
                                    <div class="li-paginatoin-area text-center pt-25">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="li-pagination-box">
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Pagination End Here Area -->
                            </div>
                        </div>
                        <!-- Li's Main Content Area End Here -->
                    </div>
                </div>
            </div>
@endsection