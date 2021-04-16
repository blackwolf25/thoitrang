@extends('layout')
@section('contents')
             
			<br>
			<div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{URL::to('/trang-chu')}}">Trang chủ</a></li>
                            <li class="active">Tin tức</li>
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
                            	@foreach ($cate_blog as $key =>$cateblog)
                                <div class="col-lg-6 col-md-6">
                                    <div class="li-blog-single-item pb-25">
                                        <div class="li-blog-banner">
                                            <a href="{{url::to('/danh-muc-tin-tuc/'.$cateblog->slug_category_post)}}"><img class="img-full" src="{{asset('public/uploads/images/post/'.$cateblog->category_image)}}" alt=""></a>
                                        </div>
                                        <div class="li-blog-content">
                                            <div class="li-blog-details">
                                                <h3 class="li-blog-heading pt-25"><a href="{{url::to('/danh-muc-tin-tuc/'.$cateblog->slug_category_post)}}">{{$cateblog->category_name}}</a></h3>
                                                <p>{{$cateblog->category_desc}}</p>
                                                
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